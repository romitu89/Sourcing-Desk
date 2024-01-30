<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offboarded extends Model
{
    use HasFactory;
    protected $primaryKey = 'offboarded_id';
    protected $fillable = ['request_no', 'submission_id', 'offboarded_date', 'offboarded_reason', ' offboarded_by', 'remarks', 'candidate_email', 'candidate_name', 'candidate_mobile', 'processed_by', 'assigned_by'];
}
