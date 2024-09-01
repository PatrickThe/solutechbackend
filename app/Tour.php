<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    public $table = 'tours';

    protected $dates = [
        'arrival_time',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'destination_id',
        'name',
        'description',
        'price',
        'slots',
        'is_booking_open',
        'status',
        'created_at',
        'updated_at',
    ];

}
