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
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('titulo');
            $table->text('descripcion');
            $table->string('imagen')->nullable(); // ruta de la imagen
            $table->string('url_demo')->nullable(); // link al proyecto
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');

            // Tecnologías usadas
            $table->json('tecnologias')->nullable(); // array de strings

            // Fechas
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            // Orden de presentación
            $table->integer('orden')->default(0);
            $table->boolean('destacado')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};
