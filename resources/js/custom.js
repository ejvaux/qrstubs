/* ---------- AJAX SETUP ---------- */
$.ajaxSetup({
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        var msg = '';
        var file = '';
        var line = '';
        if(XMLHttpRequest.responseText != null){
            msg = XMLHttpRequest.responseJSON.message;
            file = XMLHttpRequest.responseJSON.file ;
            line = XMLHttpRequest.responseJSON.line ;
            console.log(XMLHttpRequest.responseText);
            console.log(XMLHttpRequest);
        }
        if (XMLHttpRequest.readyState == 4) {
            // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
            if(XMLHttpRequest.status == '419' || XMLHttpRequest.status == '401'){
                window.location.reload();
            }
            else if(XMLHttpRequest.status == '422'){
                var response = XMLHttpRequest.responseJSON.errors;
                var errmsgs = '';
                $.each(response, function (key, val) {
                    errmsgs += val + '<br>';
                });
                iziToast.warning({
                    title: 'ERROR',
                    message: errmsgs,
                });
            }
            else{
                iziToast.warning({
                    title: 'ERROR '+ XMLHttpRequest.status,
                    message: XMLHttpRequest.statusText + '<br>' + msg + '<br>' + file + '<br>Line: ' + line,
                });
            }
        }
        else if (XMLHttpRequest.readyState == 0) {
            // Network error (i.e. connection refused, access denied due to CORS, etc.)
            iziToast.warning({
                title: 'ERROR '+ XMLHttpRequest.status,
                message: 'Network Error',
            });
        }
        else {
            iziToast.warning({
                title: 'ERROR',
                message: 'Unknown Error',
            });
            // something weird is happening
        }
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
    $('.select2').select2({width: '100%'});
    iziToast.settings({
        position: 'topCenter',
        close: false,
        pauseOnHover: true,
    });

    Echo.channel('events')
    .listen('RealTimeMessage', (e) => {
        console.log('Clicked!');
    });

    $('#app').on('click', '#testnotif', function(e){
        $.ajax({
            url: 'testBroadcast',
            type: "get",
            global: false,
            error: function(XMLHttpRequest){
                console.log(XMLHttpRequest);
            }
        });
    });
});