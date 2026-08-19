<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title');
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('location')->nullable();
            $table->string('cv_url')->nullable();
            $table->text('about_me_text')->nullable();
            $table->integer('experience_years')->default(0);
            $table->integer('happy_clients')->default(0);
            $table->integer('projects_completed')->default(0);
            $table->integer('technologies_count')->default(0);
            $table->boolean('available_for_hire')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
