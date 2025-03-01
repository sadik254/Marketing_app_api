<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'booking_date',
        'booking_time',
        'pickup_date',
        'pickup_time',
        'pickup_location',
        'dropoff_location',
        'number_of_passengers',
        'vehicle_type',
        'booking_status',
        'remarks',
    ];
}
