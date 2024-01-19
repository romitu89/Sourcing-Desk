<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    use HasFactory;
    protected $primaryKey = 'selection_id';
    protected $fillable = ['request_no', 'submission_id', 'selection_date', 'selection_result', 'remarks', 'candidate_email', 'candidate_name', 'candidate_mobile', 'processed_by', 'assigned_by'];
}
