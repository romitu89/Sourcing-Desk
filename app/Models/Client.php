<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $primaryKey = 'client_id';
    protected $fillable = [
        'client_name', 'business_unit_name', 'sub_location', 'client_manager_name', 'client_manager_email', 'account_manager_id', 'location'
    ];
}
