<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Query;
use App\Models\ParkingSpot;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Stripe;
use Illuminate\Http\RedirectResponse;

class ReserveController extends Controller
{
    public function index()
    {
        return view('parking.reserve');
    }

    public function checkParking(Request $request)
    {
        try {
            $availableSpot = ParkingSpot::where('availability', true)->where('size', (int) $request->size)->first();

            if (!$availableSpot) {
                return redirect()->back()->with('error', 'No available parking spots.');
            }

            $time_from = strtotime($request->time_from);
            $time_to = strtotime($request->time_to);

            $duration_seconds = $time_to - $time_from;
            $duration_hours = $duration_seconds / 3600;

            $price = 0;
            $size = '';
            if ($request->size == 1) {
                $price = 3.5;
                $size = 'small';
            } elseif ($request->size == 2) {
                $price = 4.5;
                $size = 'medium';
            } else {
                $price = 5.5;
                $size = 'large';
            }

            $amount = round($price * $duration_hours, 2);

            // Store reservation data in session
            session([
                'success' => 'Parking Available',
                'price_hour' => $price,
                'price' => $amount,
                'size' => $size,
                'name' => $request->name,
                'date' => $request->date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
                'available_spot' => $availableSpot,
                'duration_hours' => $duration_hours,
                'vehicle_number' => $request->vehicle_registration,
            ]);

            return redirect()->route('reserve');
        } catch (QueryException $e) {
            Log::error('Failed to check parking availability: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to check parking availability.'], 500);
        }
    }

    public function payment()
    {
        return view('payment.index');
    }

    public function reservation(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $price = session('price');
        $date = session('date');
        $time_from = session('time_from');
        $time_to = session('time_to');
        $availableSpot = session('available_spot');
        $name = session('name');
        $vehicle_number = session('vehicle_number');

        try {
            $stripeToken = $request->input('stripeToken');

            Stripe\Charge::create([
                'amount' => $price * 100,
                'currency' => 'myr',
                'source' => $stripeToken,
                'description' => 'Test payment from itsolutionstuff.com.',
            ]);

            $user = auth()->user();

            $data = new Reservation();
            $data->id = Str::uuid();
            $data->user_id = $user->id;
            $data->name = $name;
            $data->vehicle_number = $vehicle_number;
            $data->parking_spot_id = $availableSpot->id;
            $data->date = $date;
            $data->time_from = $time_from;
            $data->time_to = $time_to;

            $data->save();

            $reservationId = $data->id;

            $randomNumber = mt_rand(1000, 9999);

            $transactionId = $randomNumber;
            session([
                'transaction_id' => $transactionId,
            ]);

            $availableSpot->availability = false;
            $availableSpot->save();

            // $payment = new Payment();
            // $payment->id = Str::uuid();
            // $payment->reservation_id = $reservationId;
            // $payment->amount = $price;
            // $payment->transaction_id = $transactionId;
            // $payment->status = 3;
            // $payment->payment_method = 'Visa';

            // $payment->save();
            // Payment successful, redirect back with success message
            // return back()->with('success', 'Payment successful!');

            return redirect()->route('payment.receipt')->with('success', 'Payment Succes');
        } catch (\Exception $e) {
            // Handle any errors that occur during the charge creation
            return back()->with('error', $e->getMessage());
        }
    }

    public function receipt()
    {
        $price_hour = session('price_hour');
        $price = session('price');
        $duration = session('duration_hours');
        $date = session('date');
        $size = session('size');
        $time_from = session('time_from');
        $time_to = session('time_to');
        $name = session('name');
        $transactionId = session('transaction_id');

        return view('payment.receipt')->with([
            'price_hour' => $price_hour,
            'price' => $price,
            'size' => $size,
            'date' => $date,
            'time_from' => $time_from,
            'time_to' => $time_to,
            'name' => $name,
            'transaction_id' => $transactionId,
            'duration' => $duration,
        ]);
    }

    public function cancelIndex()
    {
        $name = null;
        $date = null;

        $cancel_data = Reservation::where('name', $name)->where('date', $date)->get();

        return view('parking.cancel')->with('cancel_data', $cancel_data);
    }

    public function checkReservation(Request $request)
    {
        $name = $request->name;
        $date = $request->date;

        $cancel_data = Reservation::where('name', $name)->where('date', $date)->get();

        if ($cancel_data->isEmpty()) {
            return redirect()->back()->with('no_reservation', true);
        }

        return view('parking.cancel')->with('cancel_data', $cancel_data);
    }

    public function cancelProcess($id)
    {
        $reservation = Reservation::where('id', $id)->first();

        $reservation->delete();

        $parkingSpot = ParkingSpot::where('id', $reservation->parking_spot_id)->first();

        $parkingSpot->availability = 1;
        $parkingSpot->update();

        return redirect()->route('cancel.index')->with('success', 'Reservation has been cancel');
    }

    public function availableIndex()
    {
        $available_data = ParkingSpot::whereNull('id')->get();

        return view('parking.available')->with('available_data', $available_data);
    }

    public function availableCheck(Request $request)
    {
        $date = $request->date;
        $time_from = $request->time_from;
        $time_to = $request->time_to;

        $reservedParkingSpotIds = Reservation::where('date', $date)
            ->where(function ($query) use ($time_from, $time_to) {
                $query
                    ->where(function ($query) use ($time_from, $time_to) {
                        $query->where('time_from', '<', $time_to)->where('time_to', '>', $time_from);
                    })
                    ->orWhere(function ($query) use ($time_from, $time_to) {
                        $query->where('time_from', '>=', $time_from)->where('time_to', '<=', $time_to);
                    });
            })
            ->pluck('parking_spot_id');

        $allParkingSpotIds = ParkingSpot::pluck('id');

        $availableParkingSpotIds = $allParkingSpotIds->diff($reservedParkingSpotIds);

        $available_data = ParkingSpot::whereIn('id', $availableParkingSpotIds)->get();

        return view('parking.available')->with('available_data', $available_data);
    }

    public function terminateSession()
    {
        Session::forget(['success', 'size', 'price', 'date', 'time_from', 'spot_id', 'available_spot', 'name', 'transaction_id']);
        return redirect()->route('reserve');
    }
}
