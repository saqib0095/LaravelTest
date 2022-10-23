<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business_address extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'street',
        'city',
        'state',
        'post_code',
        'country'
    
    ];
}
