<?php

namespace App\Http\Middleware\Api;

use App\Traits\MessageTrait;
use Closure;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateJwt
{
    use MessageTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next, $guard = null): Response
    {
        if ($guard != null) {

            try {

                auth()->shouldUse($guard);
                $user = JWTAuth::parseToken()->authenticate($request);

            } catch (\Exception $e) {

                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return $this->responseMessage(401, false, 'Invalid token');
                } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return $this->responseMessage(401, false, 'Token expired');
                } else {
                    return $this->responseMessage(401, false, 'Token not found');
                }

            }

        } else {

            try {
                    //************* Get Guard From URL ******************//
                $url = $request->fullurl();
                $path = parse_url($url,PHP_URL_PATH);
                $segments = explode('/',$path);
                $guard = end($segments);

                auth()->shouldUse($guard);
                $user = JWTAuth::parseToken()->authenticate($request);

            } catch (\Exception $e) {

                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return $this->responseMessage(401, false, 'Invalid token');
                } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return $this->responseMessage(401, false, 'Token expired');
                } else {
                    return $this->responseMessage(401, false, 'Token not found');
                }

            }
        }

        if (!$user) {
            return $this->responseMessage(401, false, 'UnAuthorized');
        }

        return $next($request);

    }
}
