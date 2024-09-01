<?php

use App\Bus;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $buses = Bus::pluck('id');
        $rides = [];

        foreach (range(1, 50) as $id) {
            $departureTime = now()
                ->setTime(mt_rand(6, 18), collect([0, 15, 30, 45])->random(), 0)
                ->addDays(mt_rand(1, 4));

            $rides[] = [
                'destination_id'          => $buses->random(),
                'name' => $faker->unique()->city,
                'description'   => $faker->unique()->city,
                'price'  => $departureTime,
                'arrival_time'    => $departureTime->clone()->addHours(1, 6),
                'is_booking_open' => true,
            ];

            $faker->unique(true);
        }

        \App\Ride::insert($rides);
    }
}
