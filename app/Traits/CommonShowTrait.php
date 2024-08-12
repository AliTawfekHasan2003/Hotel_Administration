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

Trait CommonShowTrait {

public function Room_Type_show($id)
{
    $Room_type = Room_Type::with(["rooms", "room_services.Service"])->find($id);
        
    if (!$Room_type) {
        return $this->ReturnError("room_type not found.", 404);
    }
    
    return $this->ReturnData("Room_Type", new Room_TypeResource($Room_type), "successfully room_type displayed.");
}

public function Room_show($id)
{
    $Room = Room::with("Room_type.room_services.Service")->find($id);

    if (!$Room) {
      return $this->ReturnError("room not found.", 404);
    }

    return $this->ReturnData("Room", new RoomResource($Room), "successfully room displayed.");
}

public function Service_show($id)
{
    $service = Service::with("room_services.Room_Type")->find($id);

    if (!$service) {
        return $this->ReturnError("service not found.", 404);
    }

    return $this->ReturnData("service", new ServiceResource($service), "successfully service displayed.");
}











}