<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('RendezVous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('parking_id')->nullable()->constrained('parking');
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurant');
            $table->string('specialite', 255);
            $table->date('date');
            $table->time('time');
            $table->string('motif', 255);
            $table->string('allergies', 255)->nullable();
            $table->string('medicaments', 255)->nullable();
            $table->string('antecedents', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('RendezVous');
    }
};