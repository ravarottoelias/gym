<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymiePayment extends Model
{
    public $incrementing = false;
    protected $primaryKey = "payment_identifier";

    protected $fillable = [
        'payment_identifier',
        'status',
        'period',
        'gateway',
        'payload',
        'notification_payload',
        'notification_verified',
    ];
}
