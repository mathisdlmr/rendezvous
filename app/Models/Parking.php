<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parking';

    protected $fillable = ['date', 'immatriculation'];

    protected $casts = [
        'date' => 'date',
        'deleted_at' => 'datetime',
    ];

    public function rendezVous()
    {
        return $this->hasOne(RendezVous::class , 'parking_id');
    }

    public function fromDTO(\App\DTO\RendezVousDTO $dto): void
    {
        $this->date = $dto->date;
        $this->immatriculation = $dto->immatriculation;
    }
}