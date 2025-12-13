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
        Schema::create('propuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajo_id')->constrained('trabajos')->onDelete('cascade');
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade');

            // Detalles de la propuesta
            $table->text('carta_presentacion'); // Cover letter
            $table->decimal('tarifa_propuesta', 10, 2);
            $table->enum('tipo_tarifa', ['fijo', 'por_hora'])->default('fijo');
            $table->integer('tiempo_estimado')->nullable(); // en días

            // Estado de la propuesta
            $table->enum('estado', [
                'pendiente',
                'en_revision',
                'aceptada',
                'rechazada',
                'retirada'
            ])->default('pendiente');

            // Archivos adicionales (portafolio, CV, etc)
            $table->json('archivos_adjuntos')->nullable();

            // Fechas importantes
            $table->timestamp('aceptada_en')->nullable();
            $table->timestamp('rechazada_en')->nullable();
            $table->timestamp('vista_por_cliente_en')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Un freelancer solo puede enviar una propuesta por trabajo
            $table->unique(['trabajo_id', 'freelancer_id']);

            // Índices
            $table->index('trabajo_id');
            $table->index('freelancer_id');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propuestas');
    }
};
