<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookedRoom extends Model
{
    protected $fillable = [
        'hotel_id',
        'date'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }
}
