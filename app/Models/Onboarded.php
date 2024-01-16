<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onboarded extends Model
{
    use HasFactory;
    protected $primaryKey = 'onboarded_id';
    protected $fillable = ['request_no', 'submission_id', 'onboarded_result', 'remarks', 'onboarded_date',  'candidate_email', 'candidate_name', 'candidate_mobile', 'processed_by', 'assigned_by'];
}
