<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurant';

    protected $fillable = [
        'date', 'formule'
    ];

    public function fromRendezVous(\App\Models\RendezVous $rdv) {
        $this->date = $rdv->date;
        $this->formule = $rdv->formule;
    }
}
