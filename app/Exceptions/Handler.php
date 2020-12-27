<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function(Throwable $e){

        });
    }

    public function render($request, Throwable $e)
    {
        if($this->isModelNotFound($e)){
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'No '.lcfirst(substr($e->getModel(), strrpos($e->getModel(), '\\') + 1)).' results found!',
            ])->setStatusCode(404);
        }

        if($this->isNotFound($e)) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'The specified URL cannot be found',
            ])->setStatusCode(404);
        }

        if($this->isMethodNotFound($e)){
            return response([
                'status' => 'fail',
                'code' => 405,
                'message' => 'The specified method for the request is invalid.',
            ])->setStatusCode(405);
        }
        
        if($this->isHttp($e)){
            return response([
                'status' => 'fail',
                'code' => $e->getStatusCode(),
                'message' => $e->getMessage(),
            ])->setStatusCode($e->getStatusCode());
        }

        if($this->isQuery($e)){
            return response([
                'status' => 'fail',
                'code' => 500,
                'message' => 'Unable to process query at the server!',
            ])->setStatusCode(500);
        }

        return parent::render($request, $e);

        // unexpected error
        return response([
            'status' => 'fail',
            'code' => 500,
            'message' => 'Unexpected server exception. Try again!',
        ])->setStatusCode(500);
    }

    private function isModelNotFound($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    private function isNotFound($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    private function isMethodNotFound($e)
    {
        return $e instanceof MethodNotAllowedHttpException;
    }

    private function isHttp($e)
    {
        return $e instanceof HttpException;
    }

    private function isQuery($e)
    {
        return $e instanceof QueryException;
    }
}
