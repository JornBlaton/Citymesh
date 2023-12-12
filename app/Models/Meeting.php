<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Meeting extends Model
{
    public $table = 'bookings';
    public $timestamps = false;
    use HasFactory;
    protected $guarded=['id'];
    protected $fillable = [
        'room_id',
        'booked_for',
        'start_date',
        'end_date'
    ];

    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
