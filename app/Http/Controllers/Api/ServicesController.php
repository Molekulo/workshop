<?php

namespace App\Http\Controllers\Api;

use App\Service;
use App\Http\Resources\Service as ServiceResource;
use App\Http\Controllers\Controller;

/**
 * Class ServicesController
 * @package App\Http\Controllers\Api
 */
class ServicesController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $services = Service::all();
        return ServiceResource::collection($services);
    }
}
