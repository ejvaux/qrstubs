$(document).ready(function () {

    $.ajax({
        url: 'user',
        type:'GET',
        data:{
            'ctrl': generateControlNum(new Date())
        }
    });
});


function LoadUsrTbl(search, url = 'usrtrct'){
    $.ajax({
        url: url,
        type:'get',
        data: {
            
        },
        success: function (data) {
            $('#usertransactTable').html(data); 
        }
  });
}
LoadUsrTbl();

$('#changeQRForm').on('submit', function(e){
    e.preventDefault();

    var form = $('#changeQRForm').serialize();
    var url = $(this).attr('action');
    $.ajax({
        url: url,
        type: "POST",
        data: form,
        success: function(data) {
            $('#changeQRModal').modal("hide");

            if (data == 'success') {
                setTimeout(function () { document.location.reload(true); }, 2700);
                iziToast.success({
                    title: 'Success',
                    position: 'topCenter',
                    message: 'Editting QR code Success!',
                    timeout: 2500,
                });
            }
        },
        error:function(error){
            $('#changeQRModal').modal("hide");

            iziToast.warning({
                title: 'Failed',
                position: 'topCenter',
                message: 'Editting QR code Failed !',
            });
        }

    });
});

    







// TABLE RELOAD PAGINATE 
$('#usertransactTable').on('click', '.page-link', function(e){
    e.preventDefault();
    LoadUsrTbl('',$(this).attr('href'));
});