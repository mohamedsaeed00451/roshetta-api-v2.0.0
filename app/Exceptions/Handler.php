<?php

namespace App\Exceptions;

use App\Traits\GeneralTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;
use Illuminate\Validation\ValidationException;



class Handler extends ExceptionHandler
{
    use GeneralTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    Public function render($request, Throwable $e)
    {

        If ($e instanceof HttpResponseException) {
            Return $e->getResponse();
        }

        If ($e instanceof ValidationException) {

            return $this->responseMessage(422,false,'error',['errors' => $e->errors()]);
        }

        return parent::render($request, $e);
    }

/**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
