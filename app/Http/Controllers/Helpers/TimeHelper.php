<?php

namespace App\Http\Controllers\Helpers;

/**
 * Class TimeHelper
 * @package App\Http\Controllers\Helpers
 */
class TimeHelper
{
    /**Method allow to create end_time in db services
     *
     * @param string $time
     * @param string $startTime
     *
     * @return string
     * @throws \Exception
     */
    public static function createEndTime(string $time, string $startTime)
    {
        $time    = explode(':', $time);
        $endTime = new \DateTime($startTime);
        $endTime->add(new \DateInterval('PT' . $time[0] . 'H' . $time[1] . 'M' . $time[2] . 'S'));
        return $endTime->format('Y-m-d H:i');
    }
}
