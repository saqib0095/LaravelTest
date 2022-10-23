<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business_ratings extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'Rating',
        'Hygiene_status',
        'Last_inspection'
    ];
}
