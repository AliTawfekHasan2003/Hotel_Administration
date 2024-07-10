<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoomResources;


class Room_TypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'id'  => $this->id,
           'name' => $this->name,
           'desc' => $this->desc,
           'daily_price' => $this->daily_price,
           'monthly_price' => $this->monthly_price,
           'rooms' => $this->relationLoaded('rooms') ? RoomResource::collection($this->rooms) : [],
        ];}

}
