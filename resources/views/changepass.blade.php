@extends('layouts.app')

@section('content')

<body class="body">
    <div class="container1">
        <div class="row justify-content-center">
                <label for="name" class="col-md-2 col-form-label text-md-right">New Password</label>
     
                <div class="col-md-3">
                        <input type="password" id="password" name="password" type="text" class="form-control" required>
                </div>
        </div><br>
        <div class="row justify-content-center">
            <label for="name" class="col-md-2 col-form-label text-md-right">Verify New Password</label>
     
                <div class="col-md-3">
                        <input type="password" id="password2" name="password2" type="text" class="form-control" required>
                </div>
        </div><br>
        <div class="row justify-content-center">
                <button type="submit" style="padding:3px 50px" class="btn btn-primary">
                   Submit
                </button>
        </div><br><br><br>
    </div>
</body>

<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>


@endsection