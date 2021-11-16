$('#changePassForm').on('submit', function(e){

    e.preventDefault();

    var form = $('#changePassForm').serialize();
    var url = $(this).attr('action');
    $.ajax({
        url: url,
        type: "POST",
        data: form,
        success: function(data) {
            $("#changePassForm")[0].reset();

            if (data == 'success') {
                iziToast.success({
                    title: 'Success',
                    position: 'topCenter',
                    message: 'Change Password Success!'
                });
            }
        },
        error:function(error){

            iziToast.warning({
                title: 'Failed',
                position: 'topCenter',
                message: 'Change Password Failed!'
            });
        }

    });
});