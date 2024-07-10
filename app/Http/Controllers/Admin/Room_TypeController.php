<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room_TypeRequest;
use App\Http\Resources\Room_TypeResource;
use App\Http\Resources\Room_TypeResources;
use App\Models\Room_Type;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

use function Laravel\Prompts\warning;

class Room_TypeController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room_types = Room_Type::with("rooms")->get();

        return $this->ReturnData("room_types", Room_TypeResource::collection($room_types), "successfully get all room_types.");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Room_TypeRequest $request)
    {
        $request->validated();

        Room_Type::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "daily_price" => $request->daily_price,
            "monthly_price" => $request->monthly_price,
        ]);

        return $this->ReturnSuccess("successfully room_type created.");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Room_Type = Room_Type::where("id", $id)->with("rooms")->first();

        if (!$Room_Type) {
            return $this->ReturnError("room_type not found.", 404);
        }

        return $this->ReturnData("Room_Type", new Room_TypeResource($Room_Type), "successfully room_type displayed.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Room_TypeRequest $request, $id)
    {
        $request->validated();

        $Room_Type = Room_Type::find($id);

        if (!$Room_Type) {
            return $this->ReturnError("room_type not found.", 404);
        }

        $Room_Type->update([
            "name" => $request->name ?? $Room_Type->name,
            "desc" => $request->desc ?? $Room_Type->desc,
            "daily_price" => $request->daily_price ?? $Room_Type->name,
            "monthly_price" => $request->monthly_price ?? $Room_Type->monthly_price,
        ]);

        return $this->ReturnSuccess("successfully room_type updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Room_Type = Room_Type::find($id);

        if (!$Room_Type) {
            return $this->ReturnError("room_type not found.", 404);
        }

        $rooms = $Room_Type->rooms;

        foreach ($rooms as $room) {
            $room->delete();
        }

        $Room_Type->delete();

        return $this->ReturnSuccess("successfully room_type and its related rooms deleted.");
    }
}
