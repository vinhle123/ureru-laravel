<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\TokenService;
use Illuminate\Support\Facades\Session;

class VerifyCustomToken
{
    protected $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->input('token');
        if ($token !== Session::get('csrf_token')) {
            return response()->json(['error' => 'Invalid CSRF Token'], 403);
        }

        return $next($request);
    }
}
