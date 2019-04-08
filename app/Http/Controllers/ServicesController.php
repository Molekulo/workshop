<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Service;

/**
 * Class ServicesController
 * @package App\Http\Controllers
 */
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        return view('services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * @param CreateServiceRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateServiceRequest $request)
    {
        $attributes = $request->all();
        Service::create($attributes);

        return redirect('services');
    }

    /**
     * @param Service $service
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Service $service)
    {
        return view('services.edit', ['service' => $service]);
    }

    /**
     * @param int $serviceId
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(int $serviceId)
    {
        Service::where('id', $serviceId)->delete();

        return redirect('services');
    }
}
