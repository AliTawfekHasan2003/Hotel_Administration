<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Room_Service;
use App\Models\Service;
use App\Traits\CommonIndexTrait;
use App\Traits\CommonShowTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ResponseTrait, CommonIndexTrait, CommonShowTrait ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Service_index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $request->validated();

        Service::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "hourly_price" => $request->hourly_price,
            "daily_price"  => $request->daily_price,
            "is_limited" => $request->is_limited,
            "total_units" => $request->total_units,
        ]);

        return $this->ReturnSuccess("successfully service created.");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Service_show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, $id)
    {  
        $request->validated();

        $service = Service::find($id);

        if (!$service) {
            return $this->ReturnError("service not found.", 404);
        }

        $service->update([
            "name" => $request->name ?? $service->name,
            "desc" => $request->desc ?? $service->desc,
            "hourly_price" => $request->hourly_price ?? $service->hourly_price,
            "daily_price" => $request->daily_price ?? $service->daily_price,
            "is_limited" => $request->is_limited ?? $service->is_limited,
            "total_units" => $request->total_units ?? $service->total_units,
        ]);

        return $this->ReturnSuccess("successfully service updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return $this->ReturnError("service not found.", 404);
        }
        $room_services = $service->room_services;

        foreach ($room_services as $room_service) {
            $room_service->delete();
        }

        $service->delete();

        return $this->ReturnSuccess("successfully service with its related room_services deleted.");
    }
}
