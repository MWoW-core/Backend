<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowAuthenticatedUser extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user();
    }
}
