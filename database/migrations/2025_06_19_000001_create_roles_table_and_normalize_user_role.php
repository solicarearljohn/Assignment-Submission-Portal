<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Only create roles table if it does not exist
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id(); // 1 = Faculty, 2 = Student
                $table->string('name')->unique();
                $table->timestamps();
            });
        }

        // Only add role_id to users if it does not exist
        if (!Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')->default(2); 
                $table->foreign('role_id')->references('id')->on('roles');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id');
                $table->string('role')->default('student');
            });
        }
        if (Schema::hasTable('roles')) {
            Schema::dropIfExists('roles');
        }
    }
};
