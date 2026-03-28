# IS05 - Rendu Lot 2 (Amélioration du système de rendez-vous)

## Pour le rendu

Lien vers le repository : https://github.com/mathisdlmr/rendezvous.git

## Rappel du sujet

> "Bien que le site de prise de rendez-vous donne satisfaction, nous souhaitons un audit et une adaptation pour le rendre conforme aux normes en vigueur. Des optimisations en termes de performance et d’impact environnemental sont également souhaitées"

Pour réaliser les modifications apportées, nous nous sommes majoritairement basés sur la règlementation RGPD (mais aussi d'autres règlementations trouvables dans la 6e partie du rapport), ainsi que des recommandations en éco-conception.

## 1. Minimisation des données (RGPD Art. 5(1)(c))

> _"Les données à caractère personnel doivent être adéquates, pertinentes et limitées à ce qui est nécessaire au regard des finalités pour lesquelles elles sont traitées (minimisation des données)."_ (RGPD Art. 5(1)(c))

### Problème

La table `RendezVous` centralisait toutes les données : identité, coordonnées, antécédents médicaux, numéro de sécurité sociale, données bancaires complètes. Ces informations étaient également dupliquées dans les tables `patients` et `paiement`.
Au délà du fait que les données n'étaient pas alors adéquatement stockées, et pas forcément toutes pertinentes, on peut aussi mentionner qu'une mauvaise conception de base de données peut ajouter des traitements inutiles, notamment lors des opérations de jointure ou de recherche dans une table (ce qui augmente donc la consommation énergétique).

### Corrections apportées

| Supprimé de `RendezVous`                                                | Raison                                            | Déplacé dans               |
| ----------------------------------------------------------------------- | ------------------------------------------------- | -------------------------- |
| `nom`, `prenom`, `sexe`, `date_naissance`                               | Données identitaires, appartiennent au patient    | `patients`                 |
| `adresse`, `code_postal`, `ville`, `email`, `telephone`                 | Coordonnées personnelles non liées au RDV médical | `patients`                 |
| `securite_sociale`                                                      | Donnée sensible non nécessaire au RDV             | `patients` (hashé)         |
| `mutuelle`                                                              | Non utilisée dans l'application                   | -- Supprimée --            |
| `carte_bancaire`, `carte_titulaire`, `carte_expiration_*`, `carte_code` | Données financières, il faut une table dédiée     | `paiement` (partiellement) |
| `options`, `immatriculation`, `formule`                                 | Redondants avec `parking_id` / `restaurant_id`    | FK vers des tables dédiées |

La table `RendezVous` ne contient désormais que les champs médicaux (`specialite`, `date`, `time`, `motif`, `allergies`, `medicaments`, `antecedents`) et des clés étrangères.

---

## 2. `age` → `date_naissance`

### Problème

Stocker l'âge comme entier n'est pas forcément une bonne idée : la valeur va devoir être mise à jour chaque année... Et donc va nécessité un traitement inutile (et donc une consommation d'énergie inutile).

### Correction

Remplacement de `age INTEGER` par `date_naissance DATE` dans les tables `patients` (et suppression depuis `RendezVous`).

---

## 3. Sécurité des données sensibles

### 3.1 Numéro de Sécurité Sociale (NSS)

> \_"Le numéro de sécurité sociale ou NIR, qui contient les date et lieu de naissance, est un numéro unique : il permet donc d'identifier avec certitude la personne concernée. Pour enregistrer et utiliser le NIR, vous devez être autorisés par un texte juridique spécifique"\_ (CNIL - https://www.cnil.fr/fr/cnil-direct/question/quelles-condititions-peut-demander-le-numero-de-securite-sociale-nir)

Etant donné qu'il n'est pas mentionné que l'hopital est autorisée à stocker le NSS, nous ne pouvons donc pas le stocker en clair.

### Correction

Le NSS n'est jamais persisté. Seul son hash (`securite_sociale_hash`) est stocké.

D'un point de vue technique on utilise un mutateur de l'ORM de Laravel (Eloquent) pour hasher le NSS avant de l'insérer dans la base de données.

```php
// Patients.php — le NSS brut n'atteint jamais la BDD
public function setSecuriteSocialeAttribute(string $value): void
{
    $this->attributes['securite_sociale_hash'] = hash('sha256', $value);
}
```

Le champ `securite_sociale_hash` est aussi déclaré en tant que `$hidden` dans le Model `Patient` pour ne jamais apparaître dans une sérialisation JSON/API.

### 3.2 Données bancaires

La norme PCI-DSS (Payment Card Industry Data Security Standard) interdit formellement :

- Le stockage du CVV/CVC (code de sécurité à 3 chiffres au dos des cartes bancaires)
- Le stockage du numéro complet de carte bancaire en clair

### Corrections

Ici on va complètement supprimer le code CVV/CVC car il ne doit pas être conservé.
On va ensuite remplacer le numéro de carte bancaire par les 4 derniers chiffres et un hash du numéro complet _(garder les 4 derniers chiffres n'a pour seul intérêt de pouvoir indiquer à l'utilisateur quelle carte bancaire il a utilisé pour le paiement, sans pour autant compromettre ses données bancaires)_.

| Champ initial                           | Remplacement                                        |
| --------------------------------------- | --------------------------------------------------- |
| `carte_code` (CVV)                      | Supprimé définitivement                             |
| `carte_bancaire` (16 chiffres en clair) | `carte_last4` (4 derniers) + `carte_hash` (SHA-256) |

```php
// Paiement.php — mutateur : ne stocke que les 4 derniers chiffres + hash
public function setCarteBancaireAttribute(string $value): void
{
    $cleaned = preg_replace('/\D/', '', $value);
    $this->attributes['carte_last4'] = substr($cleaned, -4);
    $this->attributes['carte_hash']  = hash('sha256', $cleaned);
}
```

_Cette approche est très basique et nous permettait simplement de proposer une amélioration sur ce point pour le rendu. Cependant, pour un vrai environnement de production, c'est le genre de service qu'il vaut mieux (et qu'il est probablement obligatoire) confier à un prestataire spécialisé comme Stripe_

---

## 4. Politique de rétention et droit à l'effacement (RGPD Art. 5(1)(e) & Art. 17)

> _"Les données à caractère personnel doivent être conservées sous une forme permettant l'identification des personnes concernées pendant une durée n'excédant pas celle nécessaire au regard des finalités pour lesquelles elles sont traitées; les données à caractère personnel peuvent être conservées pour des durées plus longues dans la mesure où elles seront traitées exclusivement à des fins archivistiques dans l'intérêt public, à des fins de recherche scientifique ou historique ou à des fins statistiques conformément à l'article 89, paragraphe 1, pour autant que soient mises en œuvre les mesures techniques et organisationnelles appropriées requises par le présent règlement afin de garantir les droits et libertés de la personne concernée (limitation de la conservation)"_ (RGPD Art. 5(1)(e))

Pour l'article 17, nous proposons simplement un lien vers l'article de loi, afin d'éviter d'allourdir ce rapport : https://www.cnil.fr/fr/reglement-europeen-protection-donnees/chapitre3#Article17

### SoftDeletes (suppression logique)

Toutes les tables contenant des données personnelles utilisent le Soft Delete de L'ORM Eloquent utilisé par Laravel (`deleted_at`).

Cela nous permet de :

- Marquer un enregistrement comme supprimé sans l'effacer physiquement immédiatement
- Permettre une période de grâce (en cas de besoin de récupération des données)
- Satisfaire le droit à l'effacement (RGPD Art. 17) en masquant les données applicativement _(sur ce dernier point nous avons pas réussi à trouver si supprimer les données d'un point de vue applicatif suffisait ou s'il fallait aussi les supprimer physiquement de la base de données)_.

### Prunable (suppression physique)

Sur les modèles `Patients`, `RendezVous` et `Paiement`, on définit une méthode `prunable()` qui définit les règles de suppression physique après 5 ans d'inactivité :

```php
// RendezVous.php
public function prunable()
{
    return static::where('date', '<=', now()->subYears(5));
}

// Patients.php
public function prunable()
{
    return static::whereDoesntHave('rendezVous')
        ->where('updated_at', '<=', now()->subYears(5));
}
```

Ensuite, ont définit une commande artisan qui va exécuter la purge (définie dans `app/Console/Commands/PurgeOldData.php`) et qu'on peut exécuter de la manière suivante :

```bash
php artisan app:purge-old-data
```

Cette commande est planifiée pour tourner mensuellement dans le Kernel et peut être exécutée manuellement à tout moment

---

## 5. Éco-conception & Performance

### Réduction des types de colonnes

Utiliser `VARCHAR(255)` partout alloue un espace inutilement grand. On a donc réduit la taille des colonnes en fonction de leur contenu :

| Colonne                 | Avant                | Après          | Raison                   |
| ----------------------- | -------------------- | -------------- | ------------------------ |
| `nom`, `prenom`         | `VARCHAR(255)`       | `VARCHAR(100)` | Nom de personne réaliste |
| `email`                 | `VARCHAR(255)`       | `VARCHAR(150)` | Limite RFC 5321          |
| `telephone`             | `INTEGER`            | `VARCHAR(15)`  | Format +33...            |
| `immatriculation`       | `VARCHAR(255)`       | `VARCHAR(9)`   | Format français          |
| `carte_last4`           | `BIGINTEGER`         | `VARCHAR(4)`   | 4 chiffres seulement     |
| `securite_sociale_hash` | `BIGINTEGER` (clair) | `VARCHAR(64)`  | SHA-256 = 64 caractères  |

### Normalisation de la base de données

Il y avait beaucoup de données en doublons entre `RendezVous`, `patients`, `paiement`. On a donc supprimé les doublons en créant des relations entre les tables.

Cela permet de réduire :

- La duplication des données sur le disque
- Le nombre d'octets transmis lors des sauvegardes
- Le risque d'incohérence (qui peuvent nécessiter des traitements complémentaires pour reconstruire une cohérence dans la BDD)

### Suppression de l'autocomplétion `datalist`

La version initiale des views chargeait tous les noms et prénoms de patients depuis la BDD pour alimenter un datalist HTML (pour faire de l'autocomplétion). Cela constituait :

1. Une fuite de données personnelles (RGPD) — des noms de patients visibles sans authentification
2. Une requête inutile exécutée à chaque chargement de l'étape 1

Cette fonctionnalité a été supprimée.

---

## 6. Normes et références

| Norme / Principe                                   | Application                                                |
| -------------------------------------------------- | ---------------------------------------------------------- |
| **RGPD Art. 5(1)(c)** — Minimisation               | Suppression des champs non nécessaires, pas de duplication |
| **RGPD Art. 5(1)(e)** — Limitation de conservation | Trait Prunable + rétention 5 ans                           |
| **RGPD Art. 17** — Droit à l'effacement            | SoftDeletes + commande de purge                            |
| **CNIL** — Pseudonymisation                        | NSS hashé en SHA-256, `$hidden` sur les hashs              |
| **PCI-DSS** — Sécurité des paiements               | CVV jamais stocké, numéro CB hashé                         |
