<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Query;
use App\Models\ParkingSpot;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ReserveController extends Controller
{
    public function index()
    {
        return view('parking/reserve');
    }

    public function reserve(Request $request)
    {
        try {
            $availableSpot = ParkingSpot::where('availability', true)
                ->where('size', $request->size)
                ->first();

            if (!$availableSpot) {
                return redirect()->back()->with('error', 'No available parking spots.');
            }

            $user = auth()->user();

            $data = new Reservation();
            $data->id = Str::uuid(); // Generate UUID and convert to string
            $data->user_id = $user->id;
            $data->parking_spot_id = $availableSpot->id;
            $data->date = $request->date;
            $data->time_from = $request->time_from;
            $data->time_to = $request->time_to;

            $data->save();

            $availableSpot->availability = false;
            $availableSpot->save();

            return redirect()->route('reserve')->with('success', 'Success Booking');

        } catch (QueryException $e) {
            Log::error('Failed to save transaction: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
