<?php

namespace App\Services;

use Illuminate\Support\Str;

class TokenService
{
    public function generateToken()
    {
        $token = Str::random(15); 
        session(['csrf_token' => $token]); 
        return $token;
    }

    public function verifyToken($token)
    {
        return $token === session('csrf_token');
    }
}
