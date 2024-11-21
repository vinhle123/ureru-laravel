<?php

namespace App\Http\Controllers;

use App\Services\TokenService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function showForm()
    {
        $token = $this->tokenService->generateToken();
        return view('user.form', compact('token'));
    }

    public function submitForm(Request $request)
    {
        $token = $request->input('token');
        
        if ($this->tokenService->verifyToken($token)) {
            return response()->json(['message' => 'Token is valid!']);
        }

        return response()->json(['error' => 'Token is invalid or missing.'], 403);
    }
}