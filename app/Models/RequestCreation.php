<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCreation extends Model
{
    use HasFactory;
    protected $primaryKey = 'request_id';
    protected $fillable = ['subject_line', 'request_body', 'requirement_name', 'requirement_num', 'file_upload_jd', 'job_type', 'client_name', 'client_bu', 'client_location', 'client_manager', 'work_assigned_to', 'created_by', 'user_id'];
}
