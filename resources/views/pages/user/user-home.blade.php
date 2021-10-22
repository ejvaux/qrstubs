@extends('layouts.app')

@section('content')

@php
    $name = Auth::user()->qrcode;
@endphp

<body class="body">
    <div class="container1">
        <center>
        {!! QrCode::size(250)->generate($name); !!}
        </center>
    </div>
</body>

<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>


@endsection