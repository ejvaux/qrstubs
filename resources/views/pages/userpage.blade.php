<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
@php
    $name = Auth::user()->qrcode;
@endphp
<body>
 {{Auth::user()->qrcode}}

<center>{!! QrCode::size(500)->generate($name); !!}</center>

</body>
</html>