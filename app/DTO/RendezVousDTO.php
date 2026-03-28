<?php

namespace App\DTO;

class RendezVousDTO
{
    public $nom;
    public $prenom;
    public $date_naissance;
    public $sexe;
    public $adresse;
    public $complement_adresse;
    public $code_postal;
    public $ville;
    public $specialite;
    public $date;
    public $time;
    public $motif;
    public $allergies;
    public $medicaments;
    public $antecedents;
    public $securite_sociale;
    public $carte_bancaire;
    public $carte_titulaire;
    public $carte_expiration_month;
    public $carte_expiration_year;
    public $email;
    public $telephone;
    public $immatriculation;
    public $formule;
    public $options;
    public $validation_data;
    public $validation_rgpd;

    public function __construct($data = null)
    {
        if ($data) {
            $this->fromArray($data);
        }
    }

    public function fromArray($data): void
    {
        $this->nom = $data['nom'] ?? $this->nom ?? null;
        $this->prenom = $data['prenom'] ?? $this->prenom ?? null;
        $this->date_naissance = $data['date_naissance'] ?? $this->date_naissance ?? null;
        $this->sexe = $data['sexe'] ?? $this->sexe ?? null;
        $this->adresse = $data['adresse'] ?? $this->adresse ?? null;
        $this->complement_adresse = $data['complement_adresse'] ?? $this->complement_adresse ?? null;
        $this->code_postal = $data['code_postal'] ?? $this->code_postal ?? null;
        $this->ville = $data['ville'] ?? $this->ville ?? null;
        $this->specialite = $data['specialite'] ?? $this->specialite ?? null;
        $this->date = $data['date'] ?? $this->date ?? null;
        $this->time = $data['time'] ?? $this->time ?? null;
        $this->motif = $data['motif'] ?? $this->motif ?? null;
        $this->allergies = $data['allergies'] ?? $this->allergies ?? null;
        $this->medicaments = $data['medicaments'] ?? $this->medicaments ?? null;
        $this->antecedents = $data['antecedents'] ?? $this->antecedents ?? null;
        $this->securite_sociale = $data['securite_sociale'] ?? $this->securite_sociale ?? null;
        $this->carte_bancaire = $data['carte_bancaire'] ?? $this->carte_bancaire ?? null;
        $this->carte_titulaire = $data['carte_titulaire'] ?? $this->carte_titulaire ?? null;
        $this->carte_expiration_month = $data['carte_expiration_month'] ?? $this->carte_expiration_month ?? null;
        $this->carte_expiration_year = $data['carte_expiration_year'] ?? $this->carte_expiration_year ?? null;
        $this->email = $data['email'] ?? $this->email ?? null;
        $this->telephone = $data['telephone'] ?? $this->telephone ?? null;
        $this->options = $data['options'] ?? $this->options ?? null;
        $this->immatriculation = $data['immatriculation'] ?? $this->immatriculation ?? null;
        $this->formule = $data['formule'] ?? $this->formule ?? null;
        $this->validation_data = $data['validation_data'] ?? $this->validation_data ?? null;
        $this->validation_rgpd = $data['validation_rgpd'] ?? $this->validation_rgpd ?? null;
    }

    public function toArray(): array
    {
        return [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'date_naissance' => $this->date_naissance,
            'sexe' => $this->sexe,
            'adresse' => $this->adresse,
            'complement_adresse' => $this->complement_adresse,
            'code_postal' => $this->code_postal,
            'ville' => $this->ville,
            'specialite' => $this->specialite,
            'date' => $this->date,
            'time' => $this->time,
            'motif' => $this->motif,
            'allergies' => $this->allergies,
            'medicaments' => $this->medicaments,
            'antecedents' => $this->antecedents,
            'securite_sociale' => $this->securite_sociale,
            'carte_bancaire' => $this->carte_bancaire,
            'carte_titulaire' => $this->carte_titulaire,
            'carte_expiration_month' => $this->carte_expiration_month,
            'carte_expiration_year' => $this->carte_expiration_year,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'options' => $this->options,
            'immatriculation' => $this->immatriculation,
            'formule' => $this->formule,
            'validation_data' => $this->validation_data,
            'validation_rgpd' => $this->validation_rgpd,
        ];
    }
}