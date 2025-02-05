<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

use function Laravel\Prompts\error;

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

    //TODO: Estandarizar respuesta con mensaje de errores

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->renderable(function (ValidationException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
                'code'=>422,
            ], 422);
        });


        $this->renderable(function (CsvOpenException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code'=>400
            ], 400);
        });

        $this->renderable(function (CsvFormatException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code'=>400
            ], 400);
        });

        $this->renderable(function (CsvDelimiterException $e, $request)
        {
            return response()->json([
                'status'=>'error',
                'message' => $e->getMessage(),
                'code'=>422
            ],422);

        });

        $this->renderable(function (Throwable $e, $request)
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Unexpected internal server error.',
                'error'=>$e->getMessage(),
                'code'=>500

            ],500);
        });



        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
