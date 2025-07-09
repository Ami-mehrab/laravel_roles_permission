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
        Schema::create('my_jobs', function (Blueprint $table) {
        $table->id();
        $table->string('job_category');
        $table->string('job_title');
        $table->text('job_description');
        $table->text('key_responsibilities')->nullable();
        $table->text('skill_requirement')->nullable();
        $table->text('educational_requirements')->nullable();
        $table->text('experience_requirements')->nullable();
        $table->string('salary')->nullable();
        $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_jobs');
    }
};
