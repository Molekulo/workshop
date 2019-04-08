@extends('layouts.app')

@section('title', 'Create new booking')

@section('content')
    <div class="container">
    @include('schedule_form')
    @include('create_user')
    </div>
@endsection

