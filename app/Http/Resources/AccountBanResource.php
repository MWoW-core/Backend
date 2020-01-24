<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class AccountBanResource extends JsonResource
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
            'bandate' => Date::parse($this->bandate)->toDateTimeString(),
            'unbandate' => $this->when($this->unbandate, fn () => Date::parse($this->unbandate)->toDateTimeString()),
            'bannedby' => $this->bannedby,
            'banreason' => $this->banreason,
            'active' => $this->active
        ];
    }
}
