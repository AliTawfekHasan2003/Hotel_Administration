<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'hourly_price',
        'daily_price',
        'is_limited',
        'total_units',
            ];

    public function room_services()
    {
      return $this->hasMany(Room_Service::class, 'Service_id','id');
    }
}
