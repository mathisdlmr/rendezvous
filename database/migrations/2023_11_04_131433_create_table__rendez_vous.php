<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('RendezVous', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->integer('age');
            $table->string('sexe', 255);
            $table->string('adresse', 255);
            $table->string('complement_adresse', 255)->nullable();
            $table->integer('code_postal');
            $table->string('ville', 255);
            $table->string('specialite', 255);
            $table->date('date');
            $table->time('time');
            $table->string('motif', 255);
            $table->string('allergies', 255)->nullable();
            $table->string('medicaments', 255)->nullable();
            $table->string('antecedents', 255)->nullable();
            $table->bigInteger('securite_sociale');
            $table->integer('mutuelle');
            $table->bigInteger('carte_bancaire');
            $table->string('carte_titulaire', 255);
            $table->integer('carte_expiration_month');
            $table->integer('carte_expiration_year');
            $table->integer('carte_code');
            $table->string('email', 255);
            $table->integer('telephone');
            $table->string('options', 255);
            $table->string('immatriculation', 255)->nullable();
            $table->string('formule', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RendezVous');
    }
};
