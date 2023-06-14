<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'customer_id',
        'book_id',
        'quantity',
        'status'
    ];

    public $timestamps = false;
}
