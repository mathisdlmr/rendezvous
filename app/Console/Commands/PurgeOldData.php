<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\RendezVous;
use App\Models\Patients;
use App\Models\Paiement;
use App\Models\Parking;
use App\Models\Restaurant;

class PurgeOldData extends Command
{
    protected $signature = 'app:purge-old-data';
    protected $description = 'Suppression physique des données personnelles dont la durée de rétention a expiré (RGPD)';

    public function handle(): int
    {
        $this->info('Démarrage de la purge des données expirées...');

        $tables = [
            RendezVous::class ,
            Paiement::class ,
            Patients::class ,
            Parking::class ,
            Restaurant::class ,
        ];

        foreach ($tables as $model) {
            $model::pruneAll();
        }

        $this->info('Purge terminée !');

        return Command::SUCCESS;
    }
}