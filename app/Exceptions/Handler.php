<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Throwable;

class Handler extends ExceptionHandler
{
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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if($e instanceof NotFoundHttpException && $request->is('api/*')){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Record not found.'
                ], 404);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if($e instanceof ValidationException && $request->expectsJson()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation error.',
                    'errors' => $e->errors()
                ], 422);
            }

        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if($e instanceof MethodNotAllowedHttpException){

                if($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Method Not Allowed',
                        'errors' => $e->getMessage()
                    ], 405);
                }

            }

        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }


}
