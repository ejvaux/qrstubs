@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\canteen.js') }}" defer></script>
@endsection

@section('content')

<body class="body">
<div class="container1">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <video id ="preview" width="100%">
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <label>SCAN QR CODE</label>
            <input type="text" name="text" placeholder="Scan Qr here" id="text" readonly="readonly">
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</body>

<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>



@endsection