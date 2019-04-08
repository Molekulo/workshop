<?php

namespace App\Http\Controllers;

use App\Booking;
use App\CarService;
use App\Http\Requests\CreateCarServiceRequest;

/**
 * Class CarServiceController
 * @package App\Http\Controllers
 */
class CarServiceController extends Controller
{
    /**
     * @param CreateCarServiceRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCarServiceRequest $request)
    {
        $attr = $request->all();
        CarService::create($attr);
        Booking::where(
            [
                ['car_id', '=', $attr['car_id']],
                ['service_id', '=', $attr['service_id']],
            ]
        )->delete();

        return back();
    }

    /**
     * @param CreateCarServiceRequest $request
     * @param int                     $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateCarServiceRequest $request, int $id)
    {
        CarService::where('id', $id)->update(
            $request->only(
                [
                    'car_id',
                    'service_id',
                    'done_service',
                    'next_service'
                ]
            )
        );

        return back();
    }
}
