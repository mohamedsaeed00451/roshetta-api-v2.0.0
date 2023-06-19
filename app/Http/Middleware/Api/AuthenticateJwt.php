<?php

namespace App\Http\Middleware\Api;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateJwt
{
    use GeneralTrait;

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

                $rules = [
                    'type' => 'bail|required|in:admin,doctor,patient,assistant,pharmacist',
                ];
                $validation = validator::make($request->all(), $rules);
                if ($validation->fails())
                    return $this->responseMessage(400, false, 'type error', $validation->messages());

                auth()->shouldUse($request->type);
                $user = JWTAuth::parseToken()->authenticate();

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
