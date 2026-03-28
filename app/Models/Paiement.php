<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;

class Paiement extends Model
{
    use HasFactory, SoftDeletes, Prunable;

    protected $table = 'paiement';

    protected $hidden = ['carte_hash'];

    protected $fillable = [
        'patient_id',
        'carte_last4',
        'carte_hash',
        'carte_titulaire',
        'carte_expiration_month',
        'carte_expiration_year',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function setCarteBancaireAttribute(string $value): void
    {
        $cleaned = preg_replace('/\D/', '', $value);
        $this->attributes['carte_last4'] = substr($cleaned, -4);
        $this->attributes['carte_hash'] = hash('sha256', $cleaned);
    }

    public function prunable()
    {
        return static::where('updated_at', '<=', now()->subYears(5));
    }

    public function patient()
    {
        return $this->belongsTo(Patients::class , 'patient_id');
    }

    public function fromDTO(\App\DTO\RendezVousDTO $dto): void
    {
        $this->carte_titulaire = $dto->carte_titulaire;
        $this->carte_expiration_month = $dto->carte_expiration_month;
        $this->carte_expiration_year = $dto->carte_expiration_year;
        if ($dto->carte_bancaire) {
            $this->carte_bancaire = $dto->carte_bancaire;
        }
    }
}