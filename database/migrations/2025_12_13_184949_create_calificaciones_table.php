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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajo_id')->constrained('trabajos')->onDelete('cascade');
            $table->foreignId('evaluador_id')->constrained('users')->onDelete('cascade'); // quien califica
            $table->foreignId('evaluado_id')->constrained('users')->onDelete('cascade'); // quien recibe la calificación
            $table->enum('tipo', ['cliente_a_freelancer', 'freelancer_a_cliente']); // tipo de calificación

            // Calificaciones
            $table->tinyInteger('calificacion')->unsigned(); // 1 a 5 estrellas
            $table->text('comentario')->nullable();

            // Aspectos específicos (opcional, 1-5)
            $table->tinyInteger('comunicacion')->unsigned()->nullable();
            $table->tinyInteger('calidad_trabajo')->unsigned()->nullable();
            $table->tinyInteger('cumplimiento_plazo')->unsigned()->nullable();
            $table->tinyInteger('profesionalismo')->unsigned()->nullable();

            // Verificación
            $table->boolean('verificado')->default(false); // si el trabajo realmente se completó

            $table->timestamps();

            // Asegurar que solo haya una calificación por trabajo y tipo
            $table->unique(['trabajo_id', 'evaluador_id', 'tipo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
