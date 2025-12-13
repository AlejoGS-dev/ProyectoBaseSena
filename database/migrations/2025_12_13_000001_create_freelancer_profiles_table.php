<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->integer('years_experience')->default(0);
            $table->integer('jobs_completed')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->decimal('total_earned', 12, 2)->default(0);
            $table->decimal('success_rate', 5, 2)->default(0);
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('behance_url')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_profiles');
    }
};
