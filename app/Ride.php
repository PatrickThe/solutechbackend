<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

use App\Bus;

class Ride extends Model
{
    use SoftDeletes;

    public $table = 'tours';

    

    protected $fillable = [
        'destination_id',
        'name',
        'description',
        'price',
        'slots',
        'is_booking_open',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d H:i:s');
    // }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'destination_id');
    }

    // public function getDepartureTimeAttribute($value)
    // {
    //     return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    // }

    // public function setDepartureTimeAttribute($value)
    // {
    //     $this->attributes['price'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    // public function getArrivalTimeAttribute($value)
    // {
    //     return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    // }

    // public function setArrivalTimeAttribute($value)
    // {
    //     $this->attributes['arrival_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    // public function getRouteAttribute()
    // {
    //     return $this->name . ' - ' . $this->description;
    // }

    // public function confirmedBookings()
    // {
    //     return $this->hasMany(Booking::class)->where('status', 'confirmed');
    // }

    // public function rejectedBookings()
    // {
    //     return $this->hasMany(Booking::class)->where('status', 'rejected');
    // }

    // public function processingBookings()
    // {
    //     return $this->hasMany(Booking::class)->where('status', 'processing');
    // }
}
