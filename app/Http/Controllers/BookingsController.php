<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\BookingsControllerHelper;
use App\Http\Controllers\Helpers\TimeValidator;
use App\Http\Requests\BookingsRequest;
use App\Http\Requests\CreateBookingRequest;
use App\Booking;
use App\Service;
use App\Car;

/**
 * Class BookingsController
 * @package App\Http\Controllers
 */
class BookingsController extends Controller
{
    use TimeValidator;
    use BookingsControllerHelper;

    /**
     * BookingsController constructor.
     */
    public function __construct()
    {
        $this->middleware('checkClient', ['except' => ['show', 'destroy', 'store']]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $bookings = Booking::with('car', 'service')->orderBy('bookings.start_time')->get();

        return view('bookings.index', ['bookings' => $bookings]);
    }

    /**
     * @param CreateBookingRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(CreateBookingRequest $request)
    {
        $this->insertBooking($request);
        if ($request->user()->hasRole('admin')) {
            return redirect('/bookings');
        }

        return redirect('/bookings/' . $request->user()->id . '');
    }

    /**
     * @param BookingsRequest $request
     * @param int             $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(BookingsRequest $request, $id)
    {
        $bookings = Booking::with('car')->with('service')->whereIn(
            'car_id',
            array_column(
                $request->user()->cars()->get()->toArray(),
                'id'
            )
        )->orderBy('bookings.start_time')->get();

        return view('bookings.show', ['bookings' => $bookings]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $services = Service::all();
        $cars     = Car::all();

        return view('bookings.create', ['services' => $services, 'cars' => $cars]);
    }

    /**
     * @param Booking $booking
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Booking $booking)
    {
        $this->adminDelete($booking);
        $booking->delete();

        return back();
    }
}
