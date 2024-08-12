<?php

namespace App\Traits;

use App\Http\Requests\Room_TypeRequest;
use App\Http\Resources\Room_TypeResource;
use App\Http\Resources\Room_TypeResources;
use App\Models\Room_Type;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Room_Service;
use App\Models\Service;
use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Http\Resources\RoomResources;
use App\Models\Room;

Trait CommonIndexTrait {

public function Room_Type_index()
{
 $room_types = Room_Type::all();

return $this->ReturnData("room_types", Room_TypeResource::collection($room_types), "successfully get all room_types.");
}

public function Room_index()
{
 $rooms = Room::all();

 return $this->ReturnData("rooms", RoomResource::collection($rooms), "successfully get all rooms.");
}

public function Service_index()
{
$services = Service::all();

return $this->ReturnData("services",ServiceResource::collection($services), "successfully get all services.");
}
}