<?php

namespace App\Http\Controllers\API;

use App\Actions\Access\LoginUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /**
     * Process the login credentials.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $login = (new LoginUser)
            ->setRequest($request)
            ->execute();

        if (! $login) {
            return response(['message' => 'Invalid email or password.'], 401);
        }

        return response([
            'status' => 'success',
            'redirect' => route('dashboard')
        ], 200);
    }
}
