<?php

namespace App\Http\Resources;

use App\Http\Requests\Room_TypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\New_;

class  RoomResource extends JsonResource
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
        'num'  => $this->id,
        'desc' => $this->desc,
        'room_type' => $this->relationLoaded('Room_type') ? new Room_TypeResource($this->Room_type) : null
        ];
    }
}
