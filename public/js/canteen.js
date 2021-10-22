$(document).ready(function () {

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


});