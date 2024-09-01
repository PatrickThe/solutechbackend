<?php

namespace App;
use App\Booking;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    public $table = 'tickets';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'booking_id',
        'ticket_number',
    ];
    
    
    public function booking()
    {
        return $this->belongsTo(Booking::class,'booker_id');
    }

}
