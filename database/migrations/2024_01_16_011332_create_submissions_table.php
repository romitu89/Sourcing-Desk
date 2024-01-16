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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id('submission_id');
            $table->string('subject'); // auto-filled, disabled
            $table->string('request_no'); // auto-filled, disabled
            $table->string('requirement_name'); // auto-filled, disabled
            $table->string('work_assigned_by'); // auto-filled, disabled
            $table->string('client_name'); // auto-filled, disabled
            $table->string('client_manager'); // auto-filled, disabled
            $table->string('candidate_name');
            $table->string('primary_skills');
            $table->string('secondary_skills')->nullable();
            $table->integer('rate_communication'); // dropdown
            $table->integer('rate_technicality'); // dropdown
            $table->string('total_experience');
            $table->string('relevant_experience');
            $table->string('notice_period');
            $table->string('current_ctc');
            $table->string('expected_ctc');
            $table->string('mobile_number');
            $table->string('email_id');
            $table->string('candidate_profile_path'); // file upload
            $table->string('vendor_tracker_path'); // file upload
            $table->string('id_proof_path')->nullable(); // file upload
            $table->string('email_confirmation_path')->nullable(); // file upload
            $table->string('pan_card')->nullable();
            $table->string('current_location');
            $table->string('job_location');
            $table->string('location');
            $table->string('submitted_by');
            $table->string('status')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
