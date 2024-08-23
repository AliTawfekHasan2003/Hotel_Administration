<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoomResources;
use App\Models\Service;
use App\Models\Room_Service;


class Room_TypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $Room_type = [
            'id'  => $this->id,
            'name' => $this->name,
            'desc' => $this->desc,
            'daily_price' => $this->daily_price,
            'monthly_price' => $this->monthly_price,
        ];

        if ($this->relationLoaded("rooms")) {
            $Room_type['rooms']  =  RoomResource::collection($this->rooms);
        }
        if ($this->relationLoaded("room_services")) {
            foreach ($this->room_services as $Room_service) {
                if ($Room_service->relationLoaded("Service")) {
                    $Room_type['Services'][]  = new ServiceResource($Room_service->Service);
                }
            }
        }

        return $Room_type;
    }
}
