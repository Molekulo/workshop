{{-- Form for schedule techical review --}}
<div class="container" style="text-align: center;background-color: #c6c8ca;border-radius: 15px ">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <h2 class="display-8 text-center" id='schedule' style="padding:20px">Schedule a technical review</h2>
            @if(auth()->user()->hasRole('admin'))
                <form method="POST" action="/bookings">
            @else
                <form method="POST" action="api/bookings">
            @endif
                @csrf
                <div class="form-group">
                    <label>Choose service:</label><br>
                    <select name="service_id" id="service_id">
                    </select>
                </div>
                @if(auth()->user()->hasRole('admin'))
                    <div class="form-group">
                        <label for="cars">Choose car:</label><br>
                        <select name="car_id" style="width: 250px" id="cars">
                        </select>
                    </div>
                @endif
                @if(auth()->user()->hasRole('client'))
                    <div class="form-group">
                        <label for="car">Choose your car:</label><br>
                        <select name="car_id" style="width: 250px" id="car_id">
                        </select>
                    </div>
                @endif
                <div class="form-group" style="width: 250px; margin: auto">
                    <label for="datetimepicker1">Choose your date and time:</label>
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" name="start_time" class="form-control datetimepicker-input"
                               data-target="#datetimepicker1" value="{{ old('datetime') }}"/>
                        <div class="input-group-append" data-target="#datetimepicker1"
                             data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="note">Your note:</label><br>
                    <textarea name="note" id="note">{{ old('note') }}</textarea>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit"
                            style="padding: 10px; margin-bottom: 20px">Schedule service
                    </button>
                </div>
            </form>
        </div>
    </div>
    @if(session('check_time'))
        <h4 style="color:red">{{session('check_time')}}</h4>
    @endif
</div><br>
@include('errors')
<script type="text/javascript">
    $(document).ready(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            stepping: 30,
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                today: 'far fa-calendar-check-o',
                clear: 'far fa-trash',
                close: 'far fa-times'
            }
        })
        const serviceOldValue = '{{ old('service_id') }}'
        if (serviceOldValue !== '') {
            $('#service').val(serviceOldValue)
        }
        const carOldValue = '{{ old('car_id') }}'

        if (carOldValue !== '') {
            $('#car').val(carOldValue)
        }
        $.ajax({
            url: 'http://' + window.location.hostname + '/api/services',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (id, results) {
                    $.each(results, function (id, row) {
                        $('#service_id').append($('<option>')
                            .text(row.name)
                            .attr('value', row.id))
                    })
                })
            },
            error: function (xhr) {
                console.log(xhr.responseText)
            }
        })
        @if(auth()->user()->hasRole('client'))
        $.ajax({
            url: 'http://' + window.location.hostname + '/api/cars',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (id, results) {
                    $.each(results, function (id, row) {
                        $('#car_id').append($('<option>')
                            .text(row.mark + '|' + row.model + '|' + row.plate)
                            .attr('value', row.id))
                    })
                })
            },
            error: function (xhr) {
                console.log(xhr.responseText)
            }
        })
        @endif
        @if(auth()->user()->hasRole('admin'))
        $.ajax({
            url: 'http://' + window.location.hostname + '/api/all_cars',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (id, results) {
                    $.each(results, function (id, row) {
                        $('#cars').append($('<option>')
                            .text(row.mark + '|' + row.model + '|' + row.plate)
                            .attr('value', row.id))
                    })
                })
            },
            error: function (xhr) {
                console.log(xhr.responseText)
            }
        })
        @endif
    })
</script>