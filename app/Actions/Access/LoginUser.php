<?php

namespace App\Actions\Access;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUser
{
    protected $email;

    protected $password;

    public function execute()
    {
        return $this->checkCredentials();
    }

    public function setRequest(Request $request)
    {
        $this->setEmail($request->input('email'))
            ->setPassword($request->input(['password']));

        return $this;
    }

    protected function checkCredentials()
    {
        $isValid = Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ]);

        if (! $isValid) {
            return $isValid;
        }

        $user = User::where('email', $this->email)->first();

        $user->createToken('authToken')->accessToken;

        Auth::loginUsingId($user->getKey());

        return true;
    }

    protected function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    protected function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}