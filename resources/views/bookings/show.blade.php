@extends('layouts.app')

@section('title', 'Show all bookings')

@section('content')
    <div class="container" style="text-align: center">
        @if (!$bookings->count())
            <h1 class="text-center">You don't have any booking!</h1>
        @else
            <h1 class="text-center">Your bookings</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Car</th>
                    <th scope="col">Service</th>
                    <th scope="col">Note</th>
                    <th scope="col">Start time</th>
                    <th scope="col">End time</th>
                    <th scope="col">Cancel</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>Mark: <b>{{ $booking->car->mark }}</b><br> Model: {{ $booking->car->model }}<br>
                            Plate: {{ $booking->car->plate }}</td>
                        <td>{{ $booking->service->name }}</td>
                        <td>{{ $booking->note }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <form method="POST" action="/bookings/{{ $booking->id }}">
                            @method('DELETE')
                            @csrf
                            <td>
                                <button class="btn btn-danger btn-lg" type="submit"
                                        onclick="return confirm('Are you sure you want to cancel?');">Cancel
                                </button>
                            </td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert" style="width:250px; margin:auto">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div><br>
            @endif
        @endif
        <div style="margin-top: 10px">
            <a href="/#schedule">
                <button class="btn btn-primary">Add new booking</button>
            </a>
        </div>
    </div>
@endsection