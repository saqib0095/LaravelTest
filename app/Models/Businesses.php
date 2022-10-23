<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Businesses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'street',
        'city',
        'state',
        'post_code',
        'country',
        'Rating',
        'Hygiene_status',
        'Last_inspection'
    ];
}
