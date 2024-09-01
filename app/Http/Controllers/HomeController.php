<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use Gate;
use App\User;
use App\Ticket;
use App\Booking;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
       
    $approvedBookingCount = Booking::where('status', 1)->count();

    // Count non-approved bookings
    $nonApprovedBookingCount = Booking::where('status', '!=', 1)->count();

    // Count total bookings
    $totalBookingCount = Booking::count();

    // Calculate percentages
    $approvedPercentage = $totalBookingCount > 0 ? ($approvedBookingCount / $totalBookingCount) * 100 : 0;
    $nonApprovedPercentage = $totalBookingCount > 0 ? ($nonApprovedBookingCount / $totalBookingCount) * 100 : 0;

    // Pass data to the view
    return view('home', [
        'approvedBookingCount' => $approvedBookingCount,
        'nonApprovedBookingCount' => $nonApprovedBookingCount,
        'approvedPercentage' => $approvedPercentage,
        'nonApprovedPercentage' => $nonApprovedPercentage,
    ]);

    }
    
    
    
     public function dashboard()
    {
    
     $tours = Tour::select('name', 'slots')->get();

    // Cast 'slots' to integer for each tour
    $tours = $tours->map(function($tour) {
        $tour->slots = (int) $tour->slots;
        return $tour;
    });

    // Encode the updated collection to JSON
    $json = json_encode($tours);

    return $json;
    }
}
