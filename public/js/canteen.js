$(document).ready(function () {

    /*let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false,
    });
    scanner.addListener('scan', function (content) {

    });
    Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[2]);
    } else {
        console.error('No cameras found.');
    }
    }).catch(function (e) {
        console.error(e);
    });

    scanner.addListener('scan',function(c){
        document.getElementById('text').value=c;
    });*/


});

function loadcam(){
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false,
    });
    Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[2]);
    } else {
        console.error('No cameras found.');
    }
    }).catch(function (e) {
        console.error(e);
    });
    scanner.addListener('scan',function(c){
        alert(c);
        scanner.stop().then(function () {
            $("#scanModal").modal('hide');
        });
    });
};

$('#scann').on('click', function () {
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false,
    });
    scanner.addListener('scan', function (content) {

    });
    Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[2]);
    } else {
        console.error('No cameras found.');
    }
    }).catch(function (e) {
        console.error(e);
    });

    scanner.addListener('scan',function(c){
        document.getElementById('text').value=c;
        alert(c);
        scanner.stop();
    });
});

$('#scanqrBtn').on('click', function () {
    loadcam();
    $("#scanModal").modal('show');
});