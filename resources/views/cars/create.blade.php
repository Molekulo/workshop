@extends('layouts.app')

@section('title', 'Create new car')

@section('content')
    <div class="container" style="text-align: center">
        <h1>Add new car</h1>
        <form method="POST" action="/cars">
            @csrf
            <div class="form-group">
                <label for="mark">Mark:</label>
                <input type="text" name="mark" id="mark" value="{{ old('mark') }}">
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" name="model" id="model" value="{{ old('model') }}">
            </div>
            <div class="form-group">
                <label for="plate">Licence plate:</label>
                <input type="text" name="plate" id="plate" value="{{ old('plate') }}">
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="text" name="year" id="year" value="{{ old('year') }}">
            </div>
            <div class="form-group">
                <label for="engine">Engine:</label>
                <input type="text" name="engine_volume" id="engine" value="{{ old('engine_volume') }}">
            </div>
            <div class="form-group">
                <label for="power">HP:</label>
                <input type="text" name="horse_power" id="power" value="{{ old('horse_power') }}">
            </div>
            <div class="form-group">
                <label for="engine">Fuel:</label>
                <select name="fuel">
                    <option value="" selected="selected">--</option>
                    <option value="gasoline">Gasoline</option>
                    <option value="diesel">Diesel</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kilometers">Kilometers:</label>
                <input type="text" name="kilometers" id="kilometers" value="{{ old('kilometers') }}">
            </div>
            @include('errors')
            <div>
                <button class="btn btn-primary" type="submit">Add car</button>
            </div>
        </form>
        <div class="form-group" style="margin-top:10px">
            <a href="/"><button class="btn btn-danger">Cancel</button></a>
        </div>
    </div>
@endsection