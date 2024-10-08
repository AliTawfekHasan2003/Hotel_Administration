<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_Type extends Model
{
    protected $table = 'room_types';
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'daily_price',
        'monthly_price',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'Room_Type_id', 'id');
    }

    public function room_services()
    {
        return $this->hasMany(Room_Service::class, 'Room_Type_id', 'id');
    }
}
