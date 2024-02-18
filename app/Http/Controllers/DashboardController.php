<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $current_reservation = Reservation::where('user_id', auth()->user()->id)->get();

        Session::forget(['success', 'size', 'price', 'date', 'time_from', 'spot_id', 'available_spot', 'name', 'transaction_id']);

        return view('parking.current_reservation')->with('current_reservation', $current_reservation);
    }
}
