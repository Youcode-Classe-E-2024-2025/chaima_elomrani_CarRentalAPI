<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    use HasFactory;
    protected $table = 'cars';

    protected $fillable = ['name', 'model', 'color', 'price'];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    /**
     * Get the daily price attribute.
     */
    public function getDailyPriceAttribute()
    {
        return $this->price;
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
