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
        'check_in_date',
        'check_out_date',
        'adults',
        'children',
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }
}
