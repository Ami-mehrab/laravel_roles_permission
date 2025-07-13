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
        Schema::table('job_applications', function (Blueprint $table) {
            $table->string('applicant_name')->nullable()->after('user_id');
            $table->string('applicant_email')->nullable()->after('applicant_name');
            $table->string('resume_path')->nullable()->after('applicant_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn(['applicant_name', 'applicant_email', 'resume_path']);
        });
    }
};
