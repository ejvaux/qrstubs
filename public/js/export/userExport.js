/*      FUNCTIONS      */

function downloadWait(btn){
    i = 5;
    $(btn).attr('disabled',true);
    var t = setInterval(function(){
        if (i > 0) {
            $(btn).html('The download will start shortly '+('0'+i).slice(-2));
            i--;
        }
        else {
            clearInterval(t);
            $(btn).attr('disabled',false);
            $(btn).html('Re-download');
        }
    },1000);
}

/*     EVENTS      */
$('#userExportBtn').on('click', function(){
    $.ajax({
        url: 'export/user/modal',
        type:'GET',
        success: function (data) {
            $('#userModalDiv').html(data);
            $('.select2').select2({width: '100%'});
            $('#userExportModal').modal('show');
        }
    });
});
$('#userModalDiv').on('click','#userTransactionBtn', function(){
    $('#ctrl').removeClass('is-invalid');
    btn = $('#userModalDiv #userTransactionBtn');
    if ($('#ctrl').val() != '') {
        downloadWait(btn);
        $formdata = $('#userExportForm').serialize();
        var url = $('#userExportForm').attr('action')+"?" + $formdata;
        window.location = url;
    }
    else{
        $('#ctrl').addClass('is-invalid');
        /*iziToast.warning({
            title: 'Warning',
            message: 'Please select credit first.',
            position: 'topCenter',
            close: false,
            pauseOnHover: false,
        });*/
    }
});