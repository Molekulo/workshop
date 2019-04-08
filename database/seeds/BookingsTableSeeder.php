<?php

use Illuminate\Database\Seeder;

use App\Booking;
use App\Service;

class BookingsTableSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run()
    {
        $booking             = new Booking();
        $booking->car_id     = 1;
        $booking->service_id = 1;
        $booking->start_time = '2019-02-20 12:00:00';

        $time = explode(':', Service::find(1)->duration);
        $endTime = new DateTime($booking->start_time);
        $endTime->add(new DateInterval('PT' . $time[0] . 'H' .$time[1]. 'M'.$time[2]. 'S'));

        $booking->end_time   = $endTime;
        $booking->save();

        $booking             = new Booking();
        $booking->car_id     = 2;
        $booking->service_id = 2;
        $booking->start_time = '2019-02-22 10:00:00';

        $time = explode(':', Service::find(2)->duration);
        $endTime = new DateTime($booking->start_time);
        $endTime->add(new DateInterval('PT' . $time[0] . 'H' .$time[1]. 'M'.$time[2]. 'S'));

        $booking->end_time   = $endTime;
        $booking->save();
    }
}
