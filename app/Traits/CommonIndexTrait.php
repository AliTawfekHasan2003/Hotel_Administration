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

trait CommonIndexTrait
{
    use ResponseTrait, PaginationTrait;

    public function Room_Type_index()
    {
        $room_types = Room_Type::paginate(20);

        $data = Room_TypeResource::collection($room_types);
        return $this->ReturnPaginatedData($data, "successfully get room_types with pagination information.");
    }

    public function Room_index()
    {
        $rooms = Room::paginate(20);

        $data = RoomResource::collection($rooms);
        return $this->ReturnPaginatedData($data, "successfully get rooms with pagination information.");
    }

    public function Service_index()
    {
        $services = Service::paginate(20);

        $data = ServiceResource::collection($services);
        return $this->ReturnPaginatedData($data, "successfully get services with pagination information.");
    }
}
