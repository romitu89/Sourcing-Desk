<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offered extends Model
{
    use HasFactory;
    protected $primaryKey = 'offered_id';
    protected $fillable = ['request_no', 'submission_id', 'offered_date', 'offered_ctc', 'remarks', 'candidate_email', 'candidate_name', 'candidate_mobile', 'processed_by', 'assigned_by'];
}
