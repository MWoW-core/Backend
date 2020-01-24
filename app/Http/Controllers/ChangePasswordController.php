<?php

namespace App\Http\Controllers;

use App\AccountPassword;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __invoke(ChangePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->input('password'))
        ]);

        AccountPassword::update(
            $request->input('password'),
            $request->user()->account()
        );
    }
}
