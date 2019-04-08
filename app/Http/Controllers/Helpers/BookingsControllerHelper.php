<?php

namespace App\Http\Controllers\Helpers;

use App\Booking;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Updaters\BookingUpdate;
use App\Service;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

/**
 * Trait BookingsControllerHelper
 * @package App\Http\Controllers\Helpers
 */
trait BookingsControllerHelper
{
    /**
     * @param CreateBookingRequest $request
     *
     * @throws \Exception
     */
    public function insertBooking(CreateBookingRequest $request)
    {
        $this->checkStartTime($request->start_time);
        $duration = Service::find($request->service_id)->duration;
        $endTime  = (new BookingUpdate())->generateEnd($request->start_time, $duration);
        $this->tryAppointment($request->start_time, $endTime, $duration);
        $attributes             = $request->all();
        $attributes['end_time'] = $endTime;
        Booking::create($attributes);
    }

    /**
     * @param Booking $booking
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function adminDelete(Booking $booking)
    {
        if (auth()->user()->hasRole('admin')) {
            $booking->delete();

            return back();
        }
        TimeValidator::checkTime($booking->start_time);
    }

    /**
     * @param string $startTime
     * @param string $endTime
     * @param string $duration
     *
     * @throws \Exception
     */
    public function tryAppointment($startTime, $endTime, $duration)
    {
        if ((!(new BookingUpdate())->isAvailable($startTime, $endTime))) {
            $nextAvailable = (new BookingUpdate())->nextAvailableAppointment($startTime, $duration);
            throw ValidationException::withMessages(
                ['busy' => 'Your time is busy, choose another. Next available at ' . $nextAvailable]
            );
        }
    }

    /**
     * @param string $begin
     */
    public function checkStartTime($begin)
    {
        $startTime = Carbon::parse($begin);
        TimeValidator::checkWorkshopTimeAndDate($startTime);
    }
}
