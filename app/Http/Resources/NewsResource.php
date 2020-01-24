<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class NewsResource extends JsonResource
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
            'writer' => $this->whenLoaded('writer', fn() => [
                'name' => $this->writer->name,
                'id' => $this->writer->id
            ]),

            'category' => $this->category,
            'title' => $this->title,
            'slug' => $this->slug,
            'headline' => $this->headline,
            'body' => $this->body,

            'created_at' => Date::instance($this->created_at)->toDateTimeString()
        ];
    }
}
