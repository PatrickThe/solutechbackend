<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tour;
use Illuminate\Http\Request;
use Gate;
use App\User;
use App\Ticket;


use App\Booking;

use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

    class TourController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    $tours = Tour::Select('name','price','is_booking_open')->get();
    $json = json_encode($tours);
    
     return $json;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
       
        $name = $request->input('name');
        $email = $request->input('email');
        $defaultPassword = 'password';
        $seatsArray = $request->input('seats'); // This will be a JSON string
        $seats = json_decode($seatsArray, true);
         
         
         //generate ticket number
         $randomNumber = mt_rand() / mt_getrandmax() * 10000;
         $formattedNumber = number_format($randomNumber, 8);
        

        // Remove commas from the string
        $cleanedString = str_replace(',', '', $formattedNumber);

       // Convert the cleaned string to a float
         $number = (float)$cleanedString;

        // Round the number to 1 decimal place
        $roundedNumber = round($number, 0);


          

        // Hash the default password
         $hashedPassword = Hash::make($defaultPassword);

        // Create a new user instance with the default password
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ]);
        
        
        foreach ($seats as $seat) {
          $dataname =$seat['name']; //
          $dataprice =$seat['price']; //price
          $userid = $user->id;
             
           $tour = Tour::where('name',$dataname)->first();
           $tourid = $tour->id;
           
           
           //bookings
          
            $booking = Booking::create([
            'ride_id' => $tourid,
            'user_id' => $userid,
            'status' => 1,
            ]);

            //tickets
            $ticket = Ticket::create([
            'booking_id' => $booking->id,
            'ticket_number' => $roundedNumber,
           ]);
           
           
           //now send email to user
           
        }
           
           
           
            return response()->json(['singledata' => $tourid]);
            
       
        
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
