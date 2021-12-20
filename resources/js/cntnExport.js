/*      FUNCTIONS      */
function exportTransaction(){
    $formdata = $('#transactionExportForm').serialize();
    $.ajax({
        url: '/export/transaction/download',
        type:'POST',
        //global: false,
        data: $formdata,
        success: function (data) {
            //return data;
            console.log(data);
        }
    });
}
/*      EVENTS      */
$('#trnsctBtn').on('click', function(){
    $("#transactionExportModal").modal('show');
});
$('#exportTransactionBtn').on('click', function(){
    if ($('#fromDate').val() > $('#toDate').val()) {
        Swal.fire({
            icon: 'error',
            //title: data.result,
            text: '\"To Date\" must be greater than \"From Date\".'
        });
    }
    else{
        $formdata = $('#transactionExportForm').serialize();
        var url = $('#transactionExportForm').attr('action')+"?" + $formdata;
        window.location = url;
    }
});
