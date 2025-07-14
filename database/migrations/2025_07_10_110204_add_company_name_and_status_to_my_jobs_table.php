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
        Schema::table('my_jobs', function (Blueprint $table) {
         $table->string('company_name')->nullable()->after('job_title');
         $table->enum('status', ['active', 'inactive'])->default('active')->after('company_name');
        });
    }

    public function down(): void
    {
        Schema::table('my_jobs', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'status']);
        });
    }
};
