<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

    /**
     * Run the migrations.
     */
    {
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 13)->unique();         // ex. ISI-2026-0001
            $table->string('prenom', 60);
            $table->string('nom', 60);
            $table->string('email')->unique();
            $table->date('date_naissance');
            $table->enum('sexe', ['F', 'M']);
            $table->string('telephone', 20)->nullable();
            $table->foreignId('classe_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};


