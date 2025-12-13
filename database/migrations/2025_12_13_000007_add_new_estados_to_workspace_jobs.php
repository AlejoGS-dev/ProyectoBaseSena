<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modificar el enum para agregar los nuevos estados
        DB::statement("ALTER TABLE workspace_jobs MODIFY COLUMN status ENUM('draft', 'published', 'in_progress', 'en_revision', 'requiere_cambios', 'completed', 'cancelled') DEFAULT 'published'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al enum original
        DB::statement("ALTER TABLE workspace_jobs MODIFY COLUMN status ENUM('draft', 'published', 'in_progress', 'completed', 'cancelled') DEFAULT 'published'");
    }
};
