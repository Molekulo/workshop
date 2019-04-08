<?php

namespace App\Http\Updaters;

use App\Booking;
use App\Http\Controllers\Helpers\TimeHelper;
use Carbon\Carbon;

/**
 * Class BookingUpdate
 * @package App\Http\Updaters
 */
class BookingUpdate
{
    /**
     * @var
     */
    private $hoursPerDay;

    /**
     * BookingUpdate constructor.
     */
    public function __construct()
    {
        $this->hoursPerDay = intval(config('mechanic.close')) - intval(config('mechanic.open'));
    }

    /**
     *
     * @param string $begin
     * @param string $end
     *
     * @return bool
     */
    public function isAvailable(string $begin, string $end)
    {
        return Booking::where([['start_time', '>=', $begin], ['start_time', '<', $end]])->orWhere(
                [['start_time', '<', $begin], ['end_time', '>', $begin]]
            )->count() == 0;
    }

    /**
     * @param string $begin
     * @param string $duration
     *
     * @return string
     * @throws \Exception
     */
    public function generateEnd(string $begin, string $duration)
    {
        $end = TimeHelper::createEndTime($duration, $begin);
        $end = Carbon::createFromTimeString($end);

        $this->moveEndForTomorrow($end);

        return $end;
    }

    /**
     * @param Carbon $date
     */
    public function moveEndForTomorrow(Carbon $date)
    {
        if ($date->hour > config('mechanic.close') || $date->hour < config('mechanic.open')) {
            $date->addHours(24 - $this->hoursPerDay);
        }
        if ($date->minute > 0 && $date->hour == intval(config('mechanic.close'))) {
            $date->addHours(24 - $this->hoursPerDay);
        }
    }

    /**
     * @param string $begin
     * @param string $duration
     *
     * @return Carbon
     * @throws \Exception
     */
    public function nextAvailableAppointment(string $begin, string $duration)
    {
        $nextAppointments = Booking::where('start_time', '>=', $begin)->orWhere('end_time', '>', $begin)->orderBy(
            'start_time'
        )->get();
        $i                = 0;
        $n                = count($nextAppointments) - 1;
        while ($i < $n) {
            $thisEnd = Carbon::createFromTimeString($nextAppointments[$i]->end_time);
            $this->moveEndForTomorrowIfEqual($thisEnd);
            $potentialEnd = Carbon::createFromTimeString($this->generateEnd($thisEnd->copy(), $duration));
            $nextBegin    = Carbon::createFromTimeString($nextAppointments[$i + 1]->start_time);
            if ($potentialEnd->lte($nextBegin)) {
                return $thisEnd;
            }
            $i++;
        }
        $thisEnd = Carbon::createFromTimeString($nextAppointments[$n]->end_time);
        $this->moveEndForTomorrowIfEqual($thisEnd);

        return $thisEnd;
    }

    /**
     * @param Carbon $date
     */
    public function moveEndForTomorrowIfEqual(Carbon $date)
    {
        if ($date->hour == config('mechanic.close')) {
            $date->addHours(24 - $this->hoursPerDay);
        }
    }
}
