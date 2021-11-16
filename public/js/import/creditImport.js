/*      FUNCTIONS      */

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
            $('#creditUploadBtn').html('Upload').attr('disabled',false);
            $('#upAlert').html(data.result).show();
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
    $('#userImportFile').val('');
    $('#upAlert').hide();
    $('#creditUploadBtn').html('Upload').attr('disabled',false);
});