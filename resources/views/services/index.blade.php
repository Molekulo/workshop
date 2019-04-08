@extends('layouts.app')

@section('title', 'Services')

@section('content')
    <div class="container" style="text-align: center">
        @if (count($services) == 0)
            <h1 class="text-center">You dont have any service.</h1>
        @else
            <h1 class="text-center">Your services</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Type</th>
                    <th scope="col">Cycle km</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->duration }}</td>
                        <td>{{ $service->type }}</td>
                        <td>{{ $service->cycle }}</td>
                        <form method="POST" action="/services/{{ $service->id }}">
                            @method('DELETE')
                            @csrf
                            <td><button class="btn btn-danger btn-lg" type="submit" onclick="return confirm('Are you sure you want to delete this service?');">Delete</button></td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div style="margin-top: 10px">
            <a href="/"><button class="btn btn-primary">Home</button></a>
            <a href="/services/create"><button class="btn btn-success">Add new service</button></a>
        </div>
    </div>
@endsection