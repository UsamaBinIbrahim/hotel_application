<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'hotel_id',
        'user_id',
        'full_name',
        'email',
        'phone_number',
        'total_price',
        'check_in_date',
        'check_out_date',
        'adults',
        'children',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }
}
