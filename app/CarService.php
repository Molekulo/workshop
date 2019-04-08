<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarService extends Model
{
    /**
     * @var string
     */
    protected $table = 'car_service';

    /**
     * @var array
     */
    protected $fillable = [
        'car_id',
        'service_id',
        'done_service',
        'next_service',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
