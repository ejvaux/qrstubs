@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\user.js') }}" defer></script>
@endsection

@section('content')

<body class="body">
    <div class="container1">
        <div class="row justify-content-center">
            <h1 style="font-family: Avanta Garde; font-size:4rem"><b> {{$uname}} </b></h1><br>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3"></div>
            <div class="col-md-6 justify-content-center">
                <center>
                {!! QrCode::size(250)->generate($qrcode); !!}
                </center><br>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row justify-content-center">
            <h1 style="font-family: Avanta Garde; color:red; font-size:3rem"><b> {{$balance}} </b></h1><br>
        </div>
        <div class="row justify-content-center">
            <h1 style="font-family: Avanta Garde; color:blue; font-size:3rem"><b> Balance amount </b></h1>
        </div>
    </div>
</body>

<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>


@endsection