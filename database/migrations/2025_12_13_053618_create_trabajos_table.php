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
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('freelancer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');

            $table->string('titulo', 200);
            $table->text('descripcion');

            // Presupuesto
            $table->decimal('presupuesto_min', 10, 2)->nullable();
            $table->decimal('presupuesto_max', 10, 2)->nullable();
            $table->enum('tipo_presupuesto', ['fijo', 'por_hora', 'rango'])->default('fijo');

            // Duración
            $table->integer('duracion_estimada')->nullable(); // en días
            $table->enum('modalidad', ['remoto', 'presencial', 'hibrido'])->default('remoto');

            // Estado del trabajo
            $table->enum('estado', [
                'borrador',
                'publicado',
                'en_revision',
                'asignado',
                'en_progreso',
                'completado',
                'cancelado',
                'cerrado'
            ])->default('publicado');

            // Nivel de experiencia requerido
            $table->enum('nivel_experiencia', ['principiante', 'intermedio', 'avanzado', 'experto'])->nullable();

            // Fechas importantes
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();
            $table->timestamp('fecha_limite_propuestas')->nullable();
            $table->timestamp('publicado_en')->nullable();
            $table->timestamp('asignado_en')->nullable();
            $table->timestamp('completado_en')->nullable();

            // Archivos adjuntos (path relativo)
            $table->json('archivos_adjuntos')->nullable();

            // Contador de propuestas
            $table->integer('num_propuestas')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Índices para mejorar performance
            $table->index('cliente_id');
            $table->index('freelancer_id');
            $table->index('categoria_id');
            $table->index('estado');
            $table->index('publicado_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
