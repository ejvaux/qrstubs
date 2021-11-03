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
    $formdata = $('#transactionExportForm').serialize();
    var url = $('#transactionExportForm').attr('action')+"?" + $formdata;
    window.location = url;
});
