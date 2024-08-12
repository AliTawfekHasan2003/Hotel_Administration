<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_Service extends Model
{
    protected $table = 'room_services';
    use HasFactory;

    protected $fillable = [
        "Room_Type_id",
        "Service_id",
    ];

    public function Room_Type()
    {
        return $this->belongsTo(Room_Type::class, 'Room_Type_id', 'id');
    }

    public function Service()
    {
        return $this->belongsTo(Service::class, 'Service_id', 'id');
    }
}
