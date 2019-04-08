@extends('layouts.app')

@section('title', 'Cars')

@section('content')
    <div class="container" style="text-align: center">
        <h1 class="text-center">Car history for {{ $car->mark }}, {{ $car->model }} with licence
            plate: {{ $car->plate }} {{ $car->next_service }}</h1>
        @if (count($done) == 0)
            <h1 class="text-center">You don't have any finished service on this car!</h1>
        @else
            <h1 class="text-center">Your done services:</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Next service for:</th>
                    <th scope="col">Is done this cycle service?</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($done as $finish)
                    <tr>
                        <td>{{ $finish->service->name }}</td>
                        @if(!empty($finish->next_service))
                            @if (($finish->next_service - $car->kilometers) <= 0)
                                <td style="color: red" class="blinker"><strong>You must do this service now!!!</strong></td>
                            @else
                            <td style="color:red">{{ $finish->next_service - $car->kilometers }} km</td>
                            @endif
                        <td>
                            <form method="POST" action="/car_service/{{ $finish->id }}">
                                @csrf
                                @method('PUT')
                                <input name="car_id" type="hidden" value="{{ $car->id }}"/>
                                <input name="service_id" type="hidden" value="{{ $finish->service->id }}"/>
                                <input name="done_service" type="hidden" value="{{ $car->kilometers }}"/>
                                <input name="next_service" type="hidden" value=" {{$finish->service->cycle ? $car->kilometers + $finish->service->cycle : '' }}"/>
                                <button class="btn btn-success btn-lg" type="submit" >Done</button>
                            </form>
                        </td>
                        @else
                        <td style="color:red">/</td>
                        <td></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
