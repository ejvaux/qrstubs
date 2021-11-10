/*      FUNCTIONS      */


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
    btn = $('#userModalDiv #userTransactionBtn');
    if ($('#ctrl').val() != '') {
        downloadWait(btn);
        $formdata = $('#userExportForm').serialize();
        var url = $('#userExportForm').attr('action')+"?" + $formdata;
        window.location = url;
    }
    else{
        iziToast.warning({
            title: 'Warning',
            message: 'Please select credit first.',
            position: 'topCenter',
            close: false,
            pauseOnHover: false,
        });
    }
});