<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paiement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->string('carte_last4', 4);
            $table->string('carte_hash', 64);
            $table->string('carte_titulaire', 100);
            $table->integer('carte_expiration_month');
            $table->integer('carte_expiration_year');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiement');
    }
};