<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $primaryKey = 'client_id';
    protected $fillable = [
        'client_name', 'business_unit_name', 'sub_location', 'account_manager', 'account_manager_id', 'location'
    ];
}
