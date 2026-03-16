<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $table = 'parking';

    protected $fillable = [
        'date', 'immatriculation'
    ];

    public function fromRendezVous(\App\Models\RendezVous $rdv) {
        $this->date = $rdv->date;
        $this->immatriculation = $rdv->immatriculation;
    }
}
