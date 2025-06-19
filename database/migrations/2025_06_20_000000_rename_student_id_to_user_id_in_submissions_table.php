<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            // Drop foreign key constraint on student_id
            $table->dropForeign(['student_id']);
            // Rename column student_id to user_id
            $table->renameColumn('student_id', 'user_id');
            // Add foreign key constraint on user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            // Drop foreign key constraint on user_id
            $table->dropForeign(['user_id']);
    
            $table->renameColumn('user_id', 'student_id');
            // Add foreign key constraint on student_id
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
