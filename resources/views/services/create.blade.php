@extends('layouts.app')

@section('title', 'Create new service')

@section('content')
    <div class="container" style="text-align: center">
        <h1>Add new service</h1>
        <form method="POST" action="/services">
            @csrf
            <div class="form-group">
                <label for="service">Name of the service:</label><br>
                <input type="text" name="name" id="service" value="{{ old('name') }}">
            </div>
            <div class="form-group" style="width: 200px; margin: auto">
                <label for="datetimepicker1">Choose duration for service:(h:m)</label>
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" name="duration" class="form-control datetimepicker-input"
                           data-target="#datetimepicker1" value="{{ old('duration') }}"/>
                    <div class="input-group-append" data-target="#datetimepicker1"
                         data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="cycle">Is cycle?</label><br>
                <select name="type" id="cycle">
                    <option value="non-cyclic">No</option>
                    <option value="cyclic">Yes</option>
                </select>
            </div>
            <div class="form-group hidden" id="cycle_kilometers">
                <label for="cycle_km">Cycle km</label>
                <input type="text" name="cycle" id="cycle_km" value="">
            </div>
            @include('errors')
            <div><br>
                <button class="btn btn-primary" type="submit">Add new service</button>
            </div>
        </form>
        <div class="form-group" style="margin-top:10px">
            <a href="/bookings"><button class="btn btn-danger">Cancel</button></a>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'HH:mm',
                    defaultDate: moment({ hour: 1 }),
                    stepping: 30,
                    minTime: '00:30',
                    icons: {
                        time: 'far fa-clock',
                        today: 'far fa-calendar-check-o',
                        clear: 'far fa-trash',
                        close: 'far fa-times'
                    }
                })
                let cycleKm = $('#cycle_kilometers')
                $('#cycle').change(() => {
                    cycleKm.toggleClass('hidden')
                })
            })
        </script>
    </div>
@endsection