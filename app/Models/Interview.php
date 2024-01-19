<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    protected $primaryKey = 'interview_id';
    protected $fillable = ['request_no', 'submission_id', 'location', 'interview_date', 'interview_status', ' interview_result', 'interview_feedback', 'remarks', 'candidate_email', 'candidate_name', 'candidate_mobile', 'processed_by', 'assigned_by'];
}
