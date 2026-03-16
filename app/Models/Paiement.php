<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $table = 'paiement';

    protected $fillable = [
        'carte_bancaire', 'carte_titulaire', 'carte_expiration_month', 'carte_expiration_year', 'carte_code'
    ];

    public function fromRendezVous(\App\Models\RendezVous $rdv) {
        $this->carte_bancaire = $rdv->carte_bancaire;
        $this->carte_titulaire = $rdv->carte_titulaire;
        $this->carte_expiration_month = $rdv->carte_expiration_month;
        $this->carte_expiration_year = $rdv->carte_expiration_year;
        $this->carte_code = $rdv->carte_code;
    }
}
