<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'RendezVous';

    protected $fillable = [
        'nom', 'prenom', 'age', 'sexe',
        'adresse', 'complement_adresse', 'code_postal', 'ville',
        'specialite', 'date', 'time', 'motif',
        'allergies', 'medicaments', 'antecedents',
        'securite_sociale', 'mutuelle',
        'carte_bancaire', 'carte_titulaire', 'carte_expiration_month', 'carte_expiration_year', 'carte_code',
        'email', 'telephone',
        'options', 'immatriculation', 'formule'
    ];

    public static $rules = [
        'nom' => 'required|max:255',
        'prenom' => 'required|max:255',
        'age' => 'required|integer|min:1|max:120',
        'sexe' => 'required|in:Homme,Femme,Autre',
        'adresse' => 'required|max:255',
        'complement_adresse' => 'nullable|max:255',
        'code_postal' => 'required|integer|min:1000|max:99999',
        'ville' => 'required|max:255',
        'specialite' => 'required|max:255|in:Cardiologie,Chirurgie,Dermatologie,Gériatrie,Gynécologie,Immunologie,Médecine générale,Neurologie,Oncologie,Ophtalmologie,Orthopédie,Odontologie,Pédiatrie,Psychiatrie,Radiologie,Urologie',
        'date' => 'required|date|after:today',
        'time' => 'required|date_format:H:i',
        'motif' => 'required|max:255',
        'allergies' => 'nullable|max:255',
        'medicaments' => 'nullable|max:255',
        'antecedents' => 'nullable|max:255',
        'securite_sociale' => 'required|integer|min:100000000000000|max:999999999999999',
        'mutuelle' => 'nullable|integer|min:10000000|max:99999999',
        'carte_bancaire' => 'required|integer|min:1000000000000000|max:9999999999999999',
        'carte_titulaire' => 'required|max:255',
        'carte_expiration_month' => 'required|integer|min:1|max:12',
        'carte_expiration_year' => 'required|integer|min:2021|max:2030',
        'carte_code' => 'required|integer|min:100|max:999',
        'email' => 'required|email|max:255',
        'telephone' => 'required|size:10',
        'options' => 'nullable|in:Rien,Place de Parking,Repas au restaurant,Place de Parking + Repas au restaurant',
        'immatriculation' => 'nullable|max:255',
        'formule' => 'required|in:Entrée + Plat,Plat + Dessert,Entrée + Plat + Dessert',
        'validation_data' => 'required',
        'validation_rgpd' => 'required',
    ];

    public static $errors = [
        'nom' => 'Le nom doit être une chaîne de caractères alphabétiques de 255 caractères maximum',
        'prenom' => 'Le prénom doit être une chaîne de caractères alphabétiques de 255 caractères maximum',
        'age' => 'L\'âge doit être un entier compris entre 1 et 120',
        'sexe' => 'Le sexe doit être Homme, Femme ou Autre',
        'adresse' => 'L\'adresse doit être une chaîne de caractères de 255 caractères maximum',
        'complement_adresse' => 'Le complément d\'adresse doit être une chaîne de caractères de 255 caractères maximum',
        'code_postal' => 'Le code postal doit être valide',
        'ville' => 'La ville doit être une chaîne de caractères de 255 caractères alphabétiques maximum',
        'specialite' => 'La spécialité doit être dans la liste',
        'date' => 'La date doit être une date valide, dans le future',
        'time' => 'L\'heure doit être une heure valide',
        'motif' => 'Le motif de la consulation doit être une chaîne de caractères alphabétiques de 255 caractères maximum',
        'allergies' => 'Les allergies doivent être une chaîne de caractères de 255 caractères maximum',
        'medicaments' => 'Les médicaments doivent être une chaîne de caractères de 255 caractères maximum',
        'antecedents' => 'Les antécédents doivent être une chaîne de caractères de 255 caractères maximum',
        'securite_sociale' => 'Le numéro de sécurité sociale doit être un entier de 15 chiffres',
        'mutuelle' => 'Le numéro de mutuelle doit être un entier de 8 chiffres',
        'carte_bancaire' => 'Le numéro de carte bancaire doit être un entier de 16 chiffres',
        'carte_titulaire' => 'Le titulaire de la carte doit être une chaîne de caractères alphabétiques de 255 caractères maximum',
        'carte_expiration_month' => 'Le mois d\'expiration de la carte doit être un entier compris entre 1 et 12',
        'carte_expiration_year' => 'L\'année d\'expiration de la carte doit être un entier compris entre 2021 et 2030',
        'carte_code' => 'Le code de sécurité de la carte doit être un entier de 3 chiffres',
        'email' => 'L\'email doit être une adresse email valide',
        'telephone' => 'Le numéro de téléphone doit être un entier de 10 chiffres',
        'options' => 'Les options doivent être dans la liste',
        'immatriculation' => 'L\'immatriculation doit être sous le format AA-000-AA ou 000-AA-000',
        'formule' => 'La formule doit être dans la liste',
        'validation_data' => 'Vous devez validé l\'exactitude des données',
        'validation_rgpd' => 'Vous devez accepter le traitement de vos données personnelles',
    ];

    public static $steps = [
        1 => [
            'nom', 'prenom', 'age', 'sexe'
        ],
        2 => [
            'adresse', 'complement_adresse', 'code_postal', 'ville'
        ],
        3 => [
            'specialite', 'date', 'time', 'motif'
        ],
        4 => [
            'allergies', 'medicaments', 'antecedents'
        ],
        5 => [
            'securite_sociale', 'mutuelle'
        ],
        6 => [
            'carte_bancaire', 'carte_titulaire', 'carte_expiration_month', 'carte_expiration_year', 'carte_code'
        ],
        7 => [
            'email', 'telephone'
        ],
        8 => [
            'options', 'immatriculation', 'formule'
        ],
        9 => [
            'validation_data', 'validation_rgpd'
        ]
    ];

    public function fromDTO(\App\DTO\RendezVousDTO $rendezVousDTO) {
        $this->nom = $rendezVousDTO->nom;
        $this->prenom = $rendezVousDTO->prenom;
        $this->age = $rendezVousDTO->age;
        $this->sexe = $rendezVousDTO->sexe;
        $this->adresse = $rendezVousDTO->adresse;
        $this->complement_adresse = $rendezVousDTO->complement_adresse;
        $this->code_postal = $rendezVousDTO->code_postal;
        $this->ville = $rendezVousDTO->ville;
        $this->specialite = $rendezVousDTO->specialite;
        $this->date = $rendezVousDTO->date;
        $this->time = $rendezVousDTO->time;
        $this->motif = $rendezVousDTO->motif;
        $this->allergies = $rendezVousDTO->allergies;
        $this->medicaments = $rendezVousDTO->medicaments;
        $this->antecedents = $rendezVousDTO->antecedents;
        $this->securite_sociale = $rendezVousDTO->securite_sociale;
        $this->mutuelle = $rendezVousDTO->mutuelle;
        $this->carte_bancaire = $rendezVousDTO->carte_bancaire;
        $this->carte_titulaire = $rendezVousDTO->carte_titulaire;
        $this->carte_expiration_month = $rendezVousDTO->carte_expiration_month;
        $this->carte_expiration_year = $rendezVousDTO->carte_expiration_year;
        $this->carte_code = $rendezVousDTO->carte_code;
        $this->email = $rendezVousDTO->email;
        $this->telephone = $rendezVousDTO->telephone;
        $this->options = $rendezVousDTO->options;
        $this->immatriculation = $rendezVousDTO->immatriculation;
        $this->formule = $rendezVousDTO->formule;
    }
}
