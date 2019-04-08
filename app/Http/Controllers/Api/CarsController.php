<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Car;
use App\Http\Resources\Car as CarResource;

/**
 * Class CarsController
 * @package App\Http\Controllers\Api
 */
class CarsController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $cars = Car::where('user_id', request()->user()->id)->get();
        return CarResource::collection($cars);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all()
    {
        $cars = Car::all();
        return CarResource::collection($cars);
    }
}
