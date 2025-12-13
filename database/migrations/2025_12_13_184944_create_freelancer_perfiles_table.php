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
        Schema::create('freelancer_perfiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Información profesional
            $table->string('titulo_profesional')->nullable(); // ej: "Desarrollador Full Stack"
            $table->text('biografia')->nullable();
            $table->string('ubicacion')->nullable();
            $table->decimal('tarifa_por_hora', 10, 2)->nullable();

            // Experiencia y disponibilidad
            $table->integer('anos_experiencia')->default(0);
            $table->enum('disponibilidad', ['tiempo_completo', 'medio_tiempo', 'por_proyecto'])->default('por_proyecto');
            $table->boolean('disponible_ahora')->default(true);

            // Estadísticas calculadas
            $table->integer('trabajos_completados')->default(0);
            $table->decimal('calificacion_promedio', 3, 2)->default(0); // 0.00 a 5.00
            $table->integer('total_calificaciones')->default(0);
            $table->decimal('total_ganado', 12, 2)->default(0);
            $table->integer('propuestas_exitosas')->default(0); // propuestas aceptadas
            $table->integer('total_propuestas')->default(0);

            // Redes sociales
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('behance')->nullable();
            $table->string('website')->nullable();

            // Preferencias
            $table->json('categorias_preferidas')->nullable(); // IDs de categorías

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_perfiles');
    }
};
