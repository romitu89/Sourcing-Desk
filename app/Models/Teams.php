<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $primaryKey = 'team_id';
    protected $fillable = ['team_members', 'location', 'job_type', 'created_by', 'user_id'];
}
