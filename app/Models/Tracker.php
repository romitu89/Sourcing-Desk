<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;
    protected $primaryKey = 'tracker_id';
    protected $fillable = [
        'client_name', 'client_manager_name', 'business_unit', 'location', 'tracker_file', 'file', 'created_by', 'user_id'
    ];
}
