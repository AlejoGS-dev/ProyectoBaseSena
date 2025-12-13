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
        Schema::create('freelancer_perfil_habilidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_perfil_id')->constrained('freelancer_perfiles')->onDelete('cascade');
            $table->foreignId('habilidad_id')->constrained('habilidades')->onDelete('cascade');
            $table->timestamps();

            // Evitar duplicados
            $table->unique(['freelancer_perfil_id', 'habilidad_id'], 'fp_hab_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_perfil_habilidad');
    }
};
