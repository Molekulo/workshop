<?php

namespace App\Http\Controllers;

use App\Car;
use App\Http\Requests\CreateUserRequest;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $attributes = $request->all();
        $user       = User::create(
            [
                'name'     => $attributes['name'],
                'email'    => $attributes['email'],
                'password' => Hash::make($attributes['password']),
                'role_id'  => Role::where('name', 'client')->first()->id,
            ]
        );
        Car::create(
            [
                'mark'          => $attributes['mark'],
                'model'         => $attributes['model'],
                'plate'         => $attributes['plate'],
                'year'          => $attributes['year'],
                'engine_volume' => $attributes['engine_volume'],
                'horse_power'   => $attributes['horse_power'],
                'fuel'          => $attributes['fuel'],
                'kilometers'    => $attributes['kilometers'],
                'user_id'       => $user->id,
            ]
        );

        return back()->with('success', 'You created user and his car!');
    }
}
