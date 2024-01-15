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
        Schema::create('trackers', function (Blueprint $table) {
            $table->id('tracker_id'); // Primary Key
            $table->string('client_name');
            $table->string('client_manager_name');
            $table->string('business_unit');
            $table->string('location');
            $table->string('tracker_file'); // File path
            $table->string('created_by'); // Email ID
            $table->unsignedBigInteger('user_id'); // Foreign Key

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackers');
    }
};
