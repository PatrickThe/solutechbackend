<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidesTable extends Migration
{
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->datetime('price');
            $table->datetime('arrival_time');
            $table->boolean('is_booking_open')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
