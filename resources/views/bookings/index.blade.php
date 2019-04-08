@extends('layouts.app')

@section('title', 'All services')

@section('content')
    <div class="container" style="text-align: center">
        @if (count($bookings) == 0)
            <h1 class="text-center">You dont have any bookings.</h1>
        @else
            <h1 class="text-center">All bookings</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Car</th>
                    <th scope="col">Service</th>
                    <th scope="col">Start time</th>
                    <th scope="col">End time</th>
                    <th scope="col">Note</th>
                    <th scope="col">Is done?</th>
                    <th scope="col">Cancel</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking['car']['mark'] }}</td>
                        <td>{{ $booking->service->name }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>{{ $booking->note }}</td>
                        <form method="POST" action="/car_service">
                            @csrf
                            <input name="car_id" type="hidden" value="{{ $booking['car']['id'] }}"/>
                            <input name="service_id" type="hidden" value="{{ $booking->service->id }}"/>
                            <input name="done_service" type="hidden" value="{{ $booking['car']['kilometers'] }}"/>
                            <input name="next_service" type="hidden" value=" {{$booking->service->cycle ? $booking['car']['kilometers'] + $booking->service->cycle : '' }}"/>
                            <td><button class="btn btn-success btn-lg" type="submit" >Done</button></td>
                        </form>
                        <form method="POST" action="/bookings/{{ $booking->id }}">
                            @method('DELETE')
                            @csrf
                            <td><button class="btn btn-danger btn-lg" type="submit" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel</button></td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div style="margin-top: 10px">
            <a href="/"><button class="btn btn-primary">Home</button></a>
            <a href="/bookings/create"><button class="btn btn-success">Add new booking</button></a>
        </div>
    </div>
@endsection
