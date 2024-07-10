<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    use HasFactory;

        protected $fillable = [
            'num',
            'desc',
            'Room_Type_id',
    ];

    public function Room_type(){

    return $this->belongsTo(Room_Type::class);
    }

}
