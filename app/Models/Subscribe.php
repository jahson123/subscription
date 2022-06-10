<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = [
        'msisdn',
        'shortcode',
        'keyword',
        'status',
        'charge_price',
        'service',
        'unsubscribe_time',
        'subscribe_time',
    ];

    protected $guarded = [
        'id',
    ];
}
