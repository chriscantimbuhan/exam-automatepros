<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show the form for user login.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('users.login');
    }

    /**
     * Logout current logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        dd("user logout");
    }
}
