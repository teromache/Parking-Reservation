<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'amount',
        'transaction_id',
        'status',
        'payment_method',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
