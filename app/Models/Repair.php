<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description',
        'status',
        'startDate',
        'endDate',
        'mechanicNotes',
        'clientNotes',
        'clientId',
        'mechanicId',
        'vehicleId',
    ];
}
