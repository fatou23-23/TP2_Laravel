<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();             // ex. L1-GL
            $table->string('libelle', 100);                    // ex. Licence 1 Génie logiciel
            $table->enum('niveau', ['L1', 'L2', 'L3', 'M1', 'M2']);
            $table->string('filiere', 60);
            $table->string('annee_academique', 9);             // ex. 2026-2027
            $table->unsignedSmallInteger('effectif_max')->default(40);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
