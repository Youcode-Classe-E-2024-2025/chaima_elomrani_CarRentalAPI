<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'amount',
        'payment_date',
    ];

    protected $casts = [
        'amount' => 'integer',
        'payment_date' => 'datetime',
        'rental_id' => 'integer',
    ];

    /**
     * Get the rental associated with the payment.
     */
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
