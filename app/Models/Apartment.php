<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_price', 'room_count', 'check_in_time', 'check_out_time',
        'descriptions', 'additional_info', 'photo', 'hotel_id',
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
}
