<?php

namespace App\Http\Controllers\Helpers;

use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

/**
 * Trait TimeValidator
 * @package App\Http\Controllers\Helpers
 */
trait TimeValidator
{
    /**
     * @param $time
     *
     * @return bool
     */
    public static function checkTime($time)
    {
        $now = Carbon::now()->setTimezone('Europe/Belgrade')->diffInHours($time);
        $past = Carbon::createFromTimeString($time)->isPast();
        if ($past) {
            return true;
        }
        if ($now < 24) {
            throw ValidationException::withMessages(['cancel' => 'You can\'t cancel booking 24 hours before!']);
        }

    }

    /**
     * @param Carbon $startTime
     */
    public static function checkWorkshopTimeAndDate($startTime)
    {
        self::checkIfPastDate($startTime);
        self::checkWorkshopTime($startTime);
    }

    /**
     * @param string $startTime
     */
    public static function checkWorkshopTime($startTime)
    {
        $closeTime = Carbon::createFromTimeString(config('mechanic.close'))->format('H:i');
        $openTime  = Carbon::createFromTimeString(config('mechanic.open'))->format('H:i');
        $startTime = Carbon::createFromTimeString($startTime);
        $startTime = $startTime->format('H:i');
        if ($startTime > $closeTime || $startTime < $openTime) {
            throw ValidationException::withMessages(
                [
                    'time' => 'Workshop is closed at this time, please choose another time. Workshop is open from ' .
                              config('mechanic.open') .' to '.config('mechanic.close')
                ]
            );
        }
    }

    /**
     * @param string $startTime
     */
    public static function checkIfPastDate($startTime)
    {
        $startTime = Carbon::createFromTimeString($startTime)->format('Y-m-d H:i');
        $now       = Carbon::now()->setTimezone('Europe/Belgrade')->format('Y-m-d H:i');
        if ($startTime < $now) {
            throw ValidationException::withMessages(
                [
                    'time' => 'Date is in the past. Choose another date',
                ]
            );
        }
    }
}