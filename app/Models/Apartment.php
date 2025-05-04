<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_price',
        'hotel_id',
        'room_number',
        'type',
        'price_per_night',
        'room_count',
        'capacity',
        'check_in_time',
        'check_out_time',
        'description',
        'descriptions',
        'additional_info',
        'photo'
    ];

    protected $casts = [
        'check_in_time' => 'datetime:H:i',
        'check_out_time' => 'datetime:H:i',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/'.$this->photo) : asset('images/default-apartment.jpg');
    }
}
