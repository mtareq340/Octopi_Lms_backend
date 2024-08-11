<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use App\Http\Requests\ApiAuthRequest;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = null;
        if (isset($request->json()->all()["api_token"]) || $request->api_token) {
            $apiToken = isset($request->json()->all()["api_token"])? $request->json()->all()["api_token"] : $request->api_token;
            $user = User::where('api_token', $apiToken)->first();
        }
        if (!$user) {
            return response(responseJson(0, __('login first')), 401);
        }
        return $next($request);

    }
}
