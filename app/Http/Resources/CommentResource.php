<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;

class CommentResource extends JsonResource
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

            'authorization' => transform(Gate::forUser($request->user()), fn (GateContract $gate) => [
                'update' => $gate->allows('update', $this->resource),
                'delete' => $gate->allows('delete', $this->resource)
            ]),

            'commentator' => $this->whenLoaded('commentator', fn () => [
                'name' => $this->commentator->name
            ]),

            'comment' => $this->comment,

            'created_at' => Date::parse($this->created_at)->toDayDateTimeString()
        ];
    }
}
