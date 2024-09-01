<?php

namespace App;

use App\Notifications\BookingStatusChangeNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use App\Ride;
use App\User;

use Illuminate\Support\Facades\Notification;

class Booking extends Model
{
    use SoftDeletes;

    public $table = 'bookings';

   

    // const STATUS_SELECT = [
    //     'processing' => 'Processing',  1
    //     'confirmed'  => 'Confirmed', 2
    //     'rejected'   => 'Rejected', 0
    // ];

    protected $fillable = [
        'user_id',
        'ride_id',
        'status',
    ];

    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   

    
}
