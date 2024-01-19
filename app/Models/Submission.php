<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $primaryKey = 'submission_id';
    protected $fillable = ['subject', 'request_no', 'requirement_name', 'work_assigned_by', 'client_name', 'client_manager', 'location', 'candidate_name', 'primary_skills', 'secondary_skills', 'rate_communication', 'rate_technicality', 'total_experience', 'relevant_experience', 'pan_card', 'notice_period', 'current_ctc', 'expected_ctc', 'mobile_number', 'email_id', 'candidate_profile_path', 'vendor_tracker_path', 'id_proof_path', 'email_confirmation_path', 'current_location', 'job_location', 'submitted_by', 'status', 'reason'];
}
