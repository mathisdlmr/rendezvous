<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->date('date_naissance');
            $table->string('sexe', 25)->enum('Homme', 'Femme', 'Autre')->nullable();
            $table->string('adresse', 200)->nullable();
            $table->string('complement_adresse', 200)->nullable();
            $table->string('code_postal', 5)->nullable();
            $table->string('ville', 100)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('telephone', 15)->nullable();
            $table->string('securite_sociale_hash', 64)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};