@extends('layouts.app')

@section('title', 'Edit car')

@section('content')
    <div class="container" style="text-align: center">

        <h1>Edit car</h1>
        <form method="POST" action="/cars/{{$car->id}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="mark">Mark:</label>
                <input type="text" name="mark" id="mark" value="{{$car->mark}}">
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" name="model" id="model" value="{{$car->model}}">
            </div>
            <div class="form-group">
                <label for="plate">Licence plate:</label>
                <input type="text" name="plate" id="plate" value="{{$car->plate}}">
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="text" name="year" id="year" value="{{$car->year}}">
            </div>
            <div class="form-group">
                <label for="engine">Engine:</label>
                <input type="text" name="engine_volume" id="engine" value="{{$car->engine_volume}}">
            </div>
            <div class="form-group">
                <label for="power">HP:</label>
                <input type="text" name="horse_power" id="power" value="{{$car->horse_power}}">
            </div>
            <div class="form-group">
                <label for="engine">Fuel:</label>
                <select name="fuel">
                    <option value="gasoline">Gasoline</option>
                    <option value="diesel" selected>Diesel</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kilometers">Kilometers:</label>
                <input type="text" name="kilometers" id="kilometers" value="{{$car->kilometers}}">
            </div>
            @include('errors')
            <div>
                <button class="btn btn-primary" type="submit">Update car</button>
            </div>
        </form>
        <div class="form-group" style="margin-top:10px">
            <a href="/"><button class="btn btn-danger">Cancel</button></a>
        </div>
    </div>
@endsection