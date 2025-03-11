<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\User;


class StripeService{

    public function __construct(){
        Stripe::setApiKey(env('sk_test_51R1IkPIClD5etZS7rtsjzG6VGeA5XR5Y2KoXrOSZmEwcRCWgX3Kz00imyWW0RXrsc0TOaP37QhRACXf0SCuemXTG009QiaM4yE'));
    }

    public function createPaymentIntent($amount, ){
}
}