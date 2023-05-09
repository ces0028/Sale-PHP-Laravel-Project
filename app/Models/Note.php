<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'in_out',
        'write_date',
        'product_id',
        'price',
        'num_in',
        'num_out',
        'total_price',
        'note'
    ];
}
