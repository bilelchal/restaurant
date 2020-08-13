<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\User;


class BookingsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        $booking = new Booking();
    	return view('booking.create',compact('booking'));

    }


     public function store()
    {


     $data = request()->validate([

            'reservationDay' =>'required',
            'reservationMonth' => 'required',
            'reservationYear' => 'required',
            'reservationHour' => 'required',
            'reservationMinute' => 'required',
            'nombreCouvert' => 'required',
          ]);


      $dayreservation = $data['reservationYear'].'-'.$data['reservationMonth'].'-'. $data['reservationDay'];

      $hourResevation = $data['reservationHour'].':'.$data['reservationMinute'];


      auth()->user()->bookings()->create([
        'BookingDate' => $data['reservationYear'].'-'.$data['reservationMonth'].'-'. $data['reservationDay'],
        'BookingTime' => $data['reservationHour'].':'.$data['reservationMinute'],
        'NumberOfSeats' => $data['nombreCouvert'],

      ]);


    return redirect()->route('meals.index')->with('success','booking created successfully.');
      
    }
}
