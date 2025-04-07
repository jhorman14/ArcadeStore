<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pedidos'; // Specify the table name
    protected $fillable = ['quantity']; // Add other fillable fields if needed
}
