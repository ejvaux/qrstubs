/*      FUNCTIONS      */

function reset()
{
    $('#userImportFile').val('');
    //$('#upAlert').hide();
    $('#creditUploadBtn').html('Upload').attr('disabled',false);
}

/*      EVENTS      */
$('#uploadCreditsBtn').on('click',function(){
    $('#creditImportModal').modal('show')
});

$('#creditUploadBtn').on('click', function(){
    console.log('Uploading');
    $formdata = new FormData($('#creditImportForm')[0]);
    $('#creditUploadBtn').html('Uploading . . .').attr('disabled',true);
    $.ajax({
        type: "POST",
        url: $('#creditImportForm').attr('action'),
        data: $formdata,
        processData: false,
        contentType: false,
        global: false,
        success: function (data) {
            console.log(data);
            reset();
            //$('#upAlert').html(data.result).show();
            $('#creditImportModal').modal('hide')
            iziToast.success({
                //title: ,
                message: data.result,
                position: 'topCenter',
                close: false,
                pauseOnHover: true,
            });
        },
        error: function(err,status,tr){
            console.log('ERROR');
            console.log(err);
            console.log(err.responseJSON.message);
            iziToast.warning({
                title: status,
                message: err.responseJSON.message,
                position: 'topCenter',
                close: false,
                pauseOnHover: true,
            });
            $('#creditUploadBtn').html('Upload').attr('disabled',false);
        }
    });
});

$('#creditImportModal').on('hide.bs.modal', function (event) {
    console.log('close');
    reset();
});