<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteHotel extends Model
{
    protected $casts = [
        'created_at' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
