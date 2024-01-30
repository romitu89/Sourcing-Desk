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
        Schema::create('offboardeds', function (Blueprint $table) {
            $table->id('offboarded_id');
            $table->string('request_no');
            $table->unsignedBigInteger('submission_id');
            $table->string('offboarded_date');
            $table->text('offboarded_reason')->nullable();
            $table->text('offboarded_by');

            $table->string('candidate_name'); // Add candidate name column
            $table->string('candidate_email'); // Add candidate email column
            $table->string('candidate_mobile'); // Add candidate mobile column
            $table->text('remarks')->nullable();
            $table->string('processed_by');
            $table->string('assigned_by');


            $table->foreign('submission_id')->references('submission_id')->on('submissions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offboardeds');
    }
};
