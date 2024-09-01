<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Bus extends Model
{
    //use SoftDeletes;

    public $table = 'destination';


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
       
    ];

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d H:i:s');
    // }

    // public function getSelectNameAttribute()
    // {
    //     return $this->name . ' (' . $this->slug . ' ' . \Str::plural('place', $this->slug) . ')';
    // }
}
