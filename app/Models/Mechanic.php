<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'cin',
        'address',
        'phoneNumber',
        'recruitmentDate',
        'userId'
    ];
}
