<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('my_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('employer_id')->nullable();
    
            // Optional: If you want to enforce foreign key constraint
            // $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('my_jobs', function (Blueprint $table) {
            $table->dropColumn('employer_id');
        });
    }
    
};
