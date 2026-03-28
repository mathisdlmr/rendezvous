<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'restaurant';

    protected $fillable = ['date', 'formule'];

    protected $casts = [
        'date' => 'date',
        'deleted_at' => 'datetime',
    ];

    public function rendezVous()
    {
        return $this->hasOne(RendezVous::class , 'restaurant_id');
    }

    public function fromDTO(\App\DTO\RendezVousDTO $dto): void
    {
        $this->date = $dto->date;
        $this->formule = $dto->formule;
    }
}