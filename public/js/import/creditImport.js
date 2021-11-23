/*      FUNCTIONS      */

function reset()
{
    $('#userImportFile').val('');
    //$('#upAlert').hide();
    $('#creditUploadBtn').html('Upload').attr('disabled',false);
    $('#userImportFile').removeClass('is-invalid');
}

function upload()
{
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
            //console.log(data);
            reset();
            //$('#upAlert').html(data.result).show();
            if (data.status == 1) {
                iziToast.success({
                    title: 'SUCCESS',
                    message: data.result,
                });
                $('#creditImportModal').modal('hide');
            }
            else if(data.status == 0){
                errs = [];
                $.each(data.result, function(index, val){
                    a = 0;
                    $.each(errs, function(i, v){
                        if (val.attribute == v.column/* && val.errors == v.errors*/) {
                            v.values.push({
                                "row":val.row,
                                "employee_no":val.values.employee_no,
                                "name":val.values.name,
                                "amount":val.values.amount,
                            });
                            a = a+1;
                        }
                    });
                    if (a == 0) {
                        errs.push({
                            "column":val.attribute,
                            "error":val.errors[0],
                            "values":[{
                                "row":val.row,
                                "employee_no":val.values.employee_no,
                                "name":val.values.name,
                                "amount":val.values.amount,
                            }],
                        });
                    }
                    /*if (errs) {
                        a = 0;
                        $.each(errs, function(i, v){
                            if (val.attribute == v.column && val.errors[0] == v.errors) {
                                errs.values.push({
                                    "row":val.row,
                                    "employee_no":val.values.employee_no,
                                    "name":val.values.name,
                                    "amount":val.values.amount,
                                });
                                a = a+1;
                            }
                        });
                        if (a == 0) {
                            errs.push({
                                "column":val.attribute,
                                "error":val.errors[0],
                                "values":{
                                    "row":val.row,
                                    "employee_no":val.values.employee_no,
                                    "name":val.values.name,
                                    "amount":val.values.amount,
                                },
                            });
                        }
                    } else {
                        errs.push({
                            "column":val.attribute,
                            "error":val.errors[0],
                            "values":{
                                "row":val.row,
                                "employee_no":val.values.employee_no,
                                "name":val.values.name,
                                "amount":val.values.amount,
                            },
                        });
                    }*/
                });
                err = '<div class="container">';
                /*$.each(data.result, function(index, val) {
                    err = err+'<div class="row"><div class="col-3 text-left">Row:</div><div class="col text-left">'+val.row+'</div></div>';
                    err = err+'<div class="row"><div class="col-3 text-left">Column:</div><div class="col text-left">'+val.attribute+'</div></div>';
                    err = err+'<div class="row"><div class="col-3 text-left">Error:</div><div class="col text-left"><span class="text-bold">'+val.errors+'</span></div></div>';
                    err = err+`<div class="row"><div class="col"><table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Employee No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>`+ val.values.employee_no +`</td>
                        <td>`+ val.values.name +`</td>
                        <td>`+ val.values.amount +`</td>
                      </tr>
                    </tbody>
                  </table></div></div>`;
                });*/
                console.log(errs);
                $.each(errs, function(index, val) {
                    //err = err+'<div class="row"><div class="col-3 text-left">Row:</div><div class="col text-left">'+val.row+'</div></div>';
                    err = err+'<div class="row"><div class="col-3 text-left">Column:</div><div class="col text-left">'+val.column+'</div></div>';
                    err = err+'<div class="row"><div class="col-3 text-left">Error:</div><div class="col text-left"><span class="text-bold">'+val.error+'</span></div></div>';
                    err = err+`<div class="row"><div class="col"><table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Row</th>
                        <th scope="col">Employee No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>`;
                      $.each(val.values, function(i,val){
                        err = err+
                        `<tr><td>`+ val.row +`</td>
                        <td>`+ val.employee_no +`</td>
                        <td>`+ val.name +`</td>
                        <td>`+ val.amount +`</td></tr>`
                      });

                    err = err+`
                    </tbody>
                  </table></div></div>`;
                });
                err = err+'</div>';
                Swal.fire({
                    title: 'IMPORT FAILED',
                    html: err,
                })
            }
            else{
                iziToast.error({
                    title: 'Error',
                    message: 'Unknown Error',
                });
            }
        },
        /*error: function(err,status,tr){
            console.log('ERROR');
            console.log(err);
            if(err.status == 422){
                iziToast.warning({
                    title: status,
                    message: err.responseJSON.message,
                });
            }
            else{
                iziToast.warning({
                    title: status,
                    message: err.responseJSON.message,
                });
            }
        }*/
    })
    .always(function() {
        $('#creditUploadBtn').html('Upload').attr('disabled',false);
    });

}

/*      EVENTS      */
$('#uploadCreditsBtn').on('click',function(){
    $('#creditImportModal').modal('show')
});

$('#creditUploadBtn').on('click', function(){
    console.log('Uploading');
    if ($('#userImportFile')[0].files.length != 0) {
        upload();
    }
    else {
        $('#userImportFile').addClass('is-invalid');
    }
});

$('#creditImportModal').on('hide.bs.modal', function (event) {
    console.log('close');
    reset();
});