@extends('layouts.app')

@section('js')
    <!-- <script src="{{ asset('js\instascan.min.js') }}" defer></script> -->
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <video id ="preview" width="50%">
        </div>
        <div class="col-md-6">
            <label>SCAN QR CODE</label>
            <input type="text" name="text" placeholder="Scan Qr here" id="text" readonly="readonly">
        </div>
    </div>
</div>

<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>

<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {

    });
Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('No cameras found.');
    }
    }).catch(function (e) {
        console.error(e);
    });

    scanner.addListener('scan',function(c){
        document.getElementById('text').value=c;
    });
</script>

@endsection