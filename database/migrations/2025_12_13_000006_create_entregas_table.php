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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajo_id')->constrained('trabajos')->onDelete('cascade');
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade');
            $table->text('mensaje')->nullable();
            $table->string('repositorio_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->json('archivos')->nullable(); // Array de URLs o rutas de archivos subidos
            $table->integer('revision')->default(1); // Número de revisión (1, 2, 3...)
            $table->enum('estado', ['pendiente_revision', 'aprobada', 'rechazada'])->default('pendiente_revision');
            $table->text('feedback_cliente')->nullable(); // Comentarios del cliente si rechaza
            $table->timestamp('aprobada_en')->nullable();
            $table->timestamp('rechazada_en')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('entregas');
    }
};
