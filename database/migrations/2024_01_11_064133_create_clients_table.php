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
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('client_name');
            $table->string('business_unit_name');
            $table->string('sub_location');
            $table->string('location');
            $table->string('account_manager');
            $table->unsignedBigInteger('account_manager_id'); // Foreign Key to Users Table
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('account_manager_id')
                ->references('id')
                ->on('users') // Replace 'users' with the actual name of the users table
                ->onDelete('cascade'); // Delete related user if client is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
