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
        Schema::create('request_creations', function (Blueprint $table) {
            $table->id('request_id');
            $table->string('subject_line');
            $table->text('request_body');
            $table->string('requirement_name');
            $table->string('requirement_num');
            $table->string('file_upload_jd')->nullable();
            $table->string('job_type');
            $table->string('client_name');
            $table->string('client_bu');
            $table->string('client_location');
            $table->string('client_manager');
            $table->json('work_assigned_to');
            $table->unsignedBigInteger('user_id');
            $table->string('created_by');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_creations');
    }
};
