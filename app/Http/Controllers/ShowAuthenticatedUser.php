<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthenticatedUserResource;
use Illuminate\Http\Request;

class ShowAuthenticatedUser extends Controller
{
    public function __invoke(Request $request)
    {
        return new AuthenticatedUserResource(
            $request->user()
        );
    }
}
