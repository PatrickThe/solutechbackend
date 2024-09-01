<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\BookRideRequest;
use App\Ride;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function index()
    {
        $ridesDates = Ride::where('price', '>', now())
            ->where('is_booking_open', 1)
            ->orderBy('price', 'asc')
            ->get()
            ->groupBy(function ($ride) {
                return Carbon::parse($ride->price)->format('Y-m-d');
            });

        return view('front.rides', compact('ridesDates'));
    }

    public function book(Request $request)
    {
       
         $ride = Tour::create($request->all());

        $data = array_merge($request->validated(), ['status' => 'processing']);
        $ride = Ride::with('bus')
            ->withCount('confirmedBookings as bookings_count')
            ->find($request->input('ride_id'));

        if (
            !optional($ride)->bus ||
            !$ride->is_booking_open ||
            $ride->bus->slug <= $ride->bookings_count ||
            now()->lessThanOrEqualTo($ride->depart_time)
        ) {
            return redirect()->back()->withErrors(['alert' => 'This ride is no longer available']);
        }

        Booking::create($data);

        return redirect()->back()->withStatus('The ride has been successfully booked and is currently being processed');
    }
}
