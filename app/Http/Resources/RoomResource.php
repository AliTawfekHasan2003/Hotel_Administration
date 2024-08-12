<?php

namespace App\Http\Resources;

use App\Http\Requests\Room_TypeRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\New_;
use PHPUnit\Event\TestSuite\Loaded;

class  RoomResource extends JsonResource
{
  /** 
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request)
  {
    $rooms = [
      'id'  => $this->id,
      'num'  => $this->id,
      'desc' => $this->desc,
    ];

    if ($this->relationLoaded("Room_type")) {
      $rooms["Room_type"] = new Room_TypeResource($this->Room_type);
          }
    
    return $rooms;
  }
}
