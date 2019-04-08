<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarService;
use App\Http\Requests\CarRequest;
use App\Http\Requests\EditCarRequest;
use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\UpdateCarRequest;

/**
 * Class CarsController
 * @package App\Http\Controllers
 */
class CarsController extends Controller
{
    /**
     * @param CarRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(CarRequest $request)
    {
        $cars = Car::where('user_id', $request->user()->id)->get();

        return view('cars.index', ['cars' => $cars]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $car = Car::where('id', $id)->first();
        $done = CarService::where('car_id', $id)->get();
        return view('cars.show', ['car' => $car, 'done' => $done]);
    }

    /**
     * @param CreateCarRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateCarRequest $request)
    {
        $attributes            = $request->all();
        $attributes['plate']   = strtoupper($attributes['plate']);
        $attributes['user_id'] = $request->user()->id;
        Car::create($attributes);

        return redirect('cars');
    }

    /**
     * @param EditCarRequest $request
     * @param Car            $car
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit(EditCarRequest $request, Car $car)
    {
        return view('cars.edit', ['car' => $car]);
    }

    /**
     * @param UpdateCarRequest $request
     * @param int              $carId
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateCarRequest $request, int $carId)
    {
        Car::where('id', $carId)->update(
            $request->only(
                [
                    'plate',
                    'mark',
                    'model',
                    'year',
                    'engine_volume',
                    'horse_power',
                    'kilometers',
                ]
            )
        );

        return redirect('cars');
    }

    /**
     * @param CarRequest $request
     * @param int        $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(CarRequest $request, int $id)
    {
        Car::where('id', $id)->where('user_id', $request->user()->id)->delete();

        return redirect('cars');
    }
}
