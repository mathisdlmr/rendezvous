<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;

class Patients extends Model
{
    use HasFactory, SoftDeletes, Prunable;

    protected $table = 'patients';

    protected $hidden = ['securite_sociale_hash'];

    protected $fillable = [
        'nom', 'prenom', 'date_naissance', 'sexe',
        'adresse', 'complement_adresse', 'code_postal', 'ville',
        'email', 'telephone',
        'securite_sociale_hash',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'deleted_at' => 'datetime',
    ];

    public function setSecuriteSocialeAttribute(string $value): void
    {
        $this->attributes['securite_sociale_hash'] = hash('sha256', $value);
    }

    public function prunable()
    {
        return static::whereDoesntHave('rendezVous')
            ->where('updated_at', '<=', now()->subYears(5));
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class , 'patient_id');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class , 'patient_id');
    }


    public function fromDTO(\App\DTO\RendezVousDTO $dto): void
    {
        $this->nom = $dto->nom;
        $this->prenom = $dto->prenom;
        $this->date_naissance = $dto->date_naissance;
        $this->sexe = $dto->sexe;
        $this->adresse = $dto->adresse;
        $this->complement_adresse = $dto->complement_adresse;
        $this->code_postal = $dto->code_postal;
        $this->ville = $dto->ville;
        $this->email = $dto->email;
        $this->telephone = $dto->telephone;
        if ($dto->securite_sociale) {
            $this->securite_sociale = $dto->securite_sociale;
        }
    }
}