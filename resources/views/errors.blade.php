@if ($errors->any())
        <div class="alert alert-danger" role="alert" style="width:250px; margin:auto;">
            <h1>Errors</h1>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
@endif