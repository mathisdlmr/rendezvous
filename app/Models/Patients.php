<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'nom', 'prenom', 'age', 'sexe'
    ];

    public function fromRendezVous(\App\Models\RendezVous $rdv) {
        $this->nom = $rdv->nom;
        $this->prenom = $rdv->prenom;
        $this->age = $rdv->age;
        $this->sexe = $rdv->sexe;
    }
}
