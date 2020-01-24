<?php

namespace App\Http\Resources;

use App\Account;
use App\AccountUsername;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class AuthenticatedUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $account = Account::with('bans')
            ->where('username', AccountUsername::make($this->account_name))
            ->first();

        return [
            'role' => $this->role->description,
            'name' => $this->name,
            'account_name' => $this->account_name,
            'email' => $this->email,

            'account' => $this->when($account, fn () => new AccountResource($account)),
            'events' => $this->whenLoaded('storedEvents', fn () => StoredEventResource::collection($this->storedEvents))
        ];
    }
}
