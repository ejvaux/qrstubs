@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Scanner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

</head>
<body>
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

    <!-- <script>
        let scanner = new Instascan.Scanner({ video: document.getElement})
    </script> -->
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {

        });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[1]);
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
</body>
</html>
@endsection
