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
            if(XMLHttpRequest.status == '419'){
                window.location.reload();
            }
            else{
                iziToast.warning({
                    title: 'ERROR '+ XMLHttpRequest.status,
                    message: XMLHttpRequest.statusText + '<br>' + msg + '<br>' + file + '<br>Line: ' + line,
                    position: 'topCenter',
                    close: false,
                });
            }
        }
        else if (XMLHttpRequest.readyState == 0) {
            // Network error (i.e. connection refused, access denied due to CORS, etc.)
            iziToast.warning({
                title: 'ERROR '+ XMLHttpRequest.status,
                message: 'Network Error',
                position: 'topCenter',
                close: false,
            });
        }
        else {
            iziToast.warning({
                title: 'ERROR',
                message: 'Unknown Error',
                position: 'topCenter',
                close: false,
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
});