@extends('layouts.app')

@section('title', 'Cars')

@section('content')
    <div class="container" style="text-align: center">
        @if (count($cars) == 0)
            <h1 class="text-center">You dont have any cars.</h1>
        @else
        <h1 class="text-center">Your cars</h1>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Mark</th>
                <th scope="col">Model</th>
                <th scope="col">Licence plate</th>
                <th scope="col">Year</th>
                <th scope="col">Engine volume</th>
                <th scope="col">HP</th>
                <th scope="col">Fuel</th>
                <th scope="col">KM</th>
                <th scope="col">View history</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->mark }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->plate }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->engine_volume }}</td>
                    <td>{{ $car->horse_power }}</td>
                    <td>{{ $car->fuel }}</td>
                    <td>{{ $car->kilometers }}</td>
                    <td><a href="/cars/{{ $car->id }}" class="btn btn-secondary btn-lg">View</a></td>
                    <td><a href="/cars/{{ $car->id }}/edit" class="btn btn-warning btn-lg">Edit</a></td>
                    <form method="POST" action="/cars/{{ $car->id }}">
                        @method('DELETE')
                        @csrf
                        <td><button class="btn btn-danger btn-lg" type="submit" onclick="return confirm('Are you sure you want to delete this car?');">Delete</button></td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
        <div style="margin-top: 10px">
            <a href="/"><button class="btn btn-primary">Home</button></a>
            <a href="/cars/create"><button class="btn btn-success">Add new car</button></a>
        </div>
    </div>
@endsection