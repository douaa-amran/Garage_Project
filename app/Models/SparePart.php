<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    public $table = "spareparts";

    protected $fillable = [
        'name',
        'reference',
        'stock',
        'price',
        'supplierId'
    ];
}
