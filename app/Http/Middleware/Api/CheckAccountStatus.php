<?php

namespace App\Http\Middleware\Api;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->email_isActive != 1)  //check Email Is Active
            return $this->responseMessage(400, false, __('messages_trans.verify'));

        if (auth()->user()->account_isActive != 1)  //check Acount Is Active
            return $this->responseMessage(400, false, __('messages_trans.check_account_status'));

        if (auth()->user()->account_enable != 1) // check Acount Is Enable
            return $this->responseMessage(400, false, __('messages_trans.account_not_allow'));

        return $next($request);
    }
}
