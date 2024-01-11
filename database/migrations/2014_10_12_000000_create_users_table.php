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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key

            $table->string('employee_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('employee_id')->unique();
            $table->string('mobile_number');
            $table->string('email_id')->unique();
            $table->string('location');
            $table->string('department');
            $table->string('role');
            $table->string('reporting_to')->nullable();
            $table->date('dob');
            $table->string('user_status')->default('current');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
