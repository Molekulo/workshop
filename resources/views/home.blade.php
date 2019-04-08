@extends("layouts.app")

@section("title", "Welcome page")

@section("content")
    <div class="container">
        @include('carousel')
        <div class="jumbotron">
            @guest
                <h1 class="display-4 text-center">Welcome to our workshop!</h1>
                <p class="lead text-center">To schedule a technical review, please log in</p>
            @endguest
            @auth
                @if (auth()->user()->hasRole('client'))
                    @if (count(auth()->user()->cars) == 0)
                        <a class="btn btn-primary btn-lg" href="/cars/create" role="button"
                           style="width:10em; display: block; margin:auto">Add new car</a>
                    @endif
                    @if (count(auth()->user()->cars) != 0)
                        @include('schedule_form')
                    @endif
                @endif
            @endauth
        </div>
    </div>
@endsection
