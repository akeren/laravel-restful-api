<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Admin API Documentation",
     *      description="This is an administrator API for an ecomerce store.",
     *      @OA\Contact(
     *          email="akeren.dev@gmail.com"
     *      ),    
     * )
     * 
     * @OA\Server(
     *      url="http://localhost:8000/api/v1",
     *      description="Admin API server"
     * )
     * 
     * @OA\SecurityScheme(
     *      securityScheme="bearerAuth",
     *      type="http",
     *      scheme="bearer"
     * )
     */
}
