<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parking_spot_id',
        'date',
        'time_from',
        'time_to',
    ];
    protected $casts = [
        'id' => 'string',
    ];

    // protected $casts = [
    //     'date' => 'date',
    //     'time_from' => 'time',
    //     'time_to' => 'time',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parkingSpot()
    {
        return $this->belongsTo(ParkingSpot::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
