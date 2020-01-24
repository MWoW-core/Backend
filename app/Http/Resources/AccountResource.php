<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     * lastip/vp/dp/email/user/registration date/account status(banned/unbanned)
     */
    public function toArray($request)
    {
        return [
            'status' => $this->status,

            'username' => $this->username,
            'email' => $this->email,
            'reg_mail' => $this->reg_mail,
            'joindate' => $this->when($this->joindate, fn () => Date::parse($this->joindate)->toDateString()),
            'last_ip' => $this->last_ip,
            'last_attempt_ip' => $this->last_attempt_ip,
            'failed_logins' => $this->failed_logins,
            'locked' => $this->locked,
            'lock_country' => $this->lock_country,
            'last_login' => $this->when($this->last_login, fn () => Date::parse($this->last_login)->toDateTimeString()),
            'online' => $this->online,
            'expansion' => $this->expansion->description,
            'mutetime' => $this->when($this->mutetime, fn () => Date::parse($this->mutetime)->toDateTimeString()),
            'mutereason' => $this->when($this->mutereason, $this->mutereason),
            'os' => $this->os,
            'vp' => $this->vp,
            'dp' => $this->dp,

            'bans' => $this->whenLoaded('bans', fn () => AccountBanResource::collection($this->bans))
        ];
    }
}
