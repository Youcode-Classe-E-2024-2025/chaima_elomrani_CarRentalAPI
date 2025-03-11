<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'rentals';
    protected $fillable = [
        'user_id', 
        'car_id', 
        'rental_date', 
        'return_date',
    ];

 



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Check if rental can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->rental_status, [self::STATUS_PENDING]);
    }

    /**
     * Check if rental can be activated
     */
    public function canBeActivated(): bool
    {
        return $this->rental_status === self::STATUS_PENDING && 
               $this->payment_status === 'paid';
    }

    /**
     * Check if rental can be completed
     */
    public function canBeCompleted(): bool
    {
        return $this->rental_status === self::STATUS_ACTIVE;
    }
}
