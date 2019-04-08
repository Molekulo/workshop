<div class="container" style="text-align: center;background-color: #c6c8ca;border-radius: 15px; margin-top: 20px; margin-bottom: 20px ">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <h2 class="display-8 text-center" style="padding:20px">Create new user</h2>
            @if (!empty(session('success')))
                <div class="alert alert-success" role="alert" style="width:250px; margin:auto">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="/register_user">
                @csrf
                <div class="form-group">
                    <label for="username">Choose name:</label><br>
                    <input type="text" name="name" id="username" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Choose email:</label><br>
                    <input type="text" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Choose password:</label><br>
                    <input type="password" name="password" id="password">
                </div>
                <h3>Create car for user</h3>
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
                    <button class="btn btn-primary" type="submit"
                            style="padding: 10px; margin-bottom: 20px">Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>