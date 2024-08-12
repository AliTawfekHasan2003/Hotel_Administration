<?php

namespace App\Http\Resources;

use App\Models\Room_Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request)
  {
    $service = [
      "id"  => $this->id,
      "name" => $this->name,
      "desc" => $this->desc,
      "hourly_price" => $this->hourly_price,
      "daily_price"  => $this->daily_price,
    ];

    if ($this->relationLoaded("room_services")) {
      foreach ($this->room_services as $Room_service) {
        if ($Room_service->relationLoaded("Room_Type"))
          $service["room_types"][] = new Room_TypeResource($Room_service->Room_Type);
      }
    }

    return $service;
  }
}
