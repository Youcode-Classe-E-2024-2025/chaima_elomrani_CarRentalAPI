<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rentals';
    protected $fillable = ['user_id', 'car_id', 'rental_date', 'return_date'];
}
