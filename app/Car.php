<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cars
 * @package App
 * @property $id
 * @property $name
 * @property $plate
 * @property $kilometers
 * @property $deleted
 * @property $user_id
 * @method static create($attributes)
 * @method static where($userId, $Id)
 */
class Car extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable
        = [
            'plate',
            'mark',
            'model',
            'year',
            'engine_volume',
            'horse_power',
            'kilometers',
            'fuel',
            'user_id',
        ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Relation to table users
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function done()
    {
        return $this->hasMany(CarService::class);
    }
}
