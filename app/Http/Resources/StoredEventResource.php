<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class StoredEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'event' => Str::title(Str::snake(class_basename($this->event_class), ' ')),
            'properties' => $this->event_properties,
            'created_at' => Date::parse($this->created_at)->toDateTimeString()
        ];
    }
}
