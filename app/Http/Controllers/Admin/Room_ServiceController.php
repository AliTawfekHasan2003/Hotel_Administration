<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRoom_ServiceRequest;
use App\Http\Requests\RevokeRoom_serviceRequest;
use App\Models\Room_Service;
use App\Models\Room_Type;
use App\Models\Service;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class Room_ServiceController extends Controller
{  
    use ResponseTrait;
    
    public function  AssignServicesToRoom_type(AssignRoom_ServiceRequest $request)
    {
        $request->validated();

        $services = $request->services;
        foreach ($services as $Service) {
            Room_Service::create([
                "Room_Type_id" => $request->Room_Type_id,
                "Service_id" => $Service
            ]);
        }

        return $this->ReturnSuccess("successfully assign services to room_type.");
    }

    public function RevokeServicesFromRoom_type(RevokeRoom_serviceRequest $request)
    {
        $request->validated();

        $services = $request->services;
        foreach ($services as $Service) {
            $Room_Service = Room_Service::where("Service_id", $Service)->where(function ($query) use ($request) {
                return $query->where("Room_Type_id", $request->Room_Type_id);
            });
            $Room_Service->delete();
        }

        return $this->ReturnSuccess("successfully revoke services from room_type.");
    }
}
