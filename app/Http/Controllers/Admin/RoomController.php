<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Http\Resources\RoomResources;
use App\Models\Room;
use App\Traits\ResponseTrait;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Traits\CommonIndexTrait;
use App\Traits\CommonShowTrait;

class RoomController extends Controller
{
  use ResponseTrait, CommonIndexTrait, CommonShowTrait;
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return $this->Room_index();
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RoomRequest $request)
  {
    $request->validated();

    Room::Create([
      "num" => $request->num,
      "desc" => $request->desc,
      "Room_Type_id" => $request->Room_Type_id,
    ]);

    return $this->ReturnSuccess("successfully room created.");
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    return $this->Room_show($id);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RoomRequest $request, $id)
  {
    $request->validated();

    $Room = Room::find($id);

    if (!$Room) {
      return $this->ReturnError("room not found.", 404);
    }

    $Room->update([
      "num" => $request->num ?? $Room->num,
      "desc" => $request->desc ?? $Room->desc,
      "Room_Type_id" => $request->Room_Type_id ?? $Room->Room_Type_id,
    ]);

    return $this->ReturnSuccess("successfully room updated.");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $Room = Room::find($id);

    if (!$Room) {
      return $this->ReturnError("room not found.", 404);
    }

    $Room->delete();

    return $this->ReturnSuccess("successfully room deleted.");
  }
}
