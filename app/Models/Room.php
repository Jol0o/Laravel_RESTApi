<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    protected $fillable = ['room_number', 'type', 'price', 'status'];

}
