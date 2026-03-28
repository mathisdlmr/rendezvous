<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;

class RendezVous extends Model
{
    use HasFactory, SoftDeletes, Prunable;

    protected $table = 'RendezVous';

    protected $fillable = [
        'patient_id',
        'parking_id',
        'restaurant_id',
        'specialite',
        'date',
        'time',
        'motif',
        'allergies',
        'medicaments',
        'antecedents',
    ];

    protected $casts = [
        'date' => 'date',
        'deleted_at' => 'datetime',
    ];

    public static $rules = [
        'nom' => 'required|max:100',
        'prenom' => 'required|max:100',
        'date_naissance' => 'required|date|before:today',
        'sexe' => 'required|in:Homme,Femme,Autre',
        'adresse' => 'required|max:200',
        'complement_adresse' => 'nullable|max:200',
        'code_postal' => 'required|digits:5',
        'ville' => 'required|max:100',
        'specialite' => 'required|max:255|in:Cardiologie,Chirurgie,Dermatologie,Gériatrie,Gynécologie,Immunologie,Médecine générale,Neurologie,Oncologie,Ophtalmologie,Orthopédie,Odontologie,Pédiatrie,Psychiatrie,Radiologie,Urologie',
        'date' => 'required|date|after:today',
        'time' => 'required|date_format:H:i',
        'motif' => 'required|max:255',
        'allergies' => 'nullable|max:255',
        'medicaments' => 'nullable|max:255',
        'antecedents' => 'nullable|max:255',
        'securite_sociale' => 'required|integer|min:100000000000000|max:999999999999999',
        'carte_bancaire' => 'required|integer|min:1000000000000000|max:9999999999999999',
        'carte_titulaire' => 'required|max:100',
        'carte_expiration_month' => 'required|integer|min:1|max:12',
        'carte_expiration_year' => 'required|integer|min:2024|max:2035',
        'email' => 'required|email|max:150',
        'telephone' => 'required|size:10',
        'options' => 'nullable|in:Rien,Place de Parking,Repas au restaurant,Place de Parking + Repas au restaurant',
        'immatriculation' => 'nullable|max:9',
        'formule' => 'required|in:Entrée + Plat,Plat + Dessert,Entrée + Plat + Dessert',
        'validation_data' => 'required',
        'validation_rgpd' => 'required',
    ];

    public static $errors = [
        'nom' => 'Le nom doit être une chaîne de caractères de 100 caractères maximum',
        'prenom' => 'Le prénom doit être une chaîne de caractères de 100 caractères maximum',
        'date_naissance' => 'La date de naissance doit être valide et dans le passé',
        'sexe' => 'Le sexe doit être Homme, Femme ou Autre',
        'adresse' => 'L\'adresse doit être valide',
        'complement_adresse' => 'Le complément d\'adresse doit être valide',
        'code_postal' => 'Le code postal doit comporter 5 chiffres',
        'ville' => 'La ville doit être valide',
        'specialite' => 'La spécialité doit être dans la liste',
        'date' => 'La date doit être une date valide, dans le future',
        'time' => 'L\'heure doit être une heure valide',
        'motif' => 'Le motif de la consulation est requis',
        'allergies' => 'Les allergies doivent être une chaîne de caractères valides',
        'medicaments' => 'Les médicaments doivent être une chaîne de caractères valides',
        'antecedents' => 'Les antécédents doivent être une chaîne de caractères valides',
        'securite_sociale' => 'Le numéro de sécurité sociale doit être un entier de 15 chiffres',
        'carte_bancaire' => 'Le numéro de carte bancaire doit être valide (16 chiffres)',
        'carte_titulaire' => 'Le titulaire de la carte doit faire 100 caractères maximum',
        'carte_expiration_month' => 'Le mois d\'expiration doit être valide',
        'carte_expiration_year' => 'L\'année d\'expiration de la carte doit être valide',
        'email' => 'L\'email doit être une adresse email valide',
        'telephone' => 'Le numéro de téléphone doit être un entier de 10 chiffres',
        'options' => 'Les options doivent être dans la liste',
        'immatriculation' => 'L\'immatriculation est invalide',
        'formule' => 'La formule doit être dans la liste',
        'validation_data' => 'Vous devez valider l\'exactitude des données',
        'validation_rgpd' => 'Vous devez accepter le traitement de vos données personnelles',
    ];

    public static $steps = [
        1 => ['nom', 'prenom', 'date_naissance', 'sexe'],
        2 => ['adresse', 'complement_adresse', 'code_postal', 'ville'],
        3 => ['specialite', 'date', 'time', 'motif'],
        4 => ['allergies', 'medicaments', 'antecedents'],
        5 => ['securite_sociale'], // mutuelle removed
        6 => ['carte_bancaire', 'carte_titulaire', 'carte_expiration_month', 'carte_expiration_year'], // CVV removed
        7 => ['email', 'telephone'],
        8 => ['options', 'immatriculation', 'formule'],
        9 => ['validation_data', 'validation_rgpd']
    ];

    public function prunable()
    {
        return static::where('date', '<=', now()->subYears(5));
    }

    public function patient()
    {
        return $this->belongsTo(Patients::class , 'patient_id');
    }

    public function parking()
    {
        return $this->belongsTo(Parking::class , 'parking_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class , 'restaurant_id');
    }

    public function fromDTO(\App\DTO\RendezVousDTO $dto): void
    {
        $this->specialite = $dto->specialite;
        $this->date = $dto->date;
        $this->time = $dto->time;
        $this->motif = $dto->motif;
        $this->allergies = $dto->allergies;
        $this->medicaments = $dto->medicaments;
        $this->antecedents = $dto->antecedents;
    }
}