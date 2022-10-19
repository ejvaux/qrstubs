$('.activebtn').on('click',function(e) {
    var form = $('#'+this.id+'_form');
    var form_data = form.serializeArray();
    var active = $(this).is(":checked") ? "1":"0";
    form_data.push({name: "active", value: active});
    var url = form.attr('action');
    console.log(form_data);
    console.log(url);
    $.ajax({
        url: url,
        type: "PUT",
        data: form_data,
        global: false,
        success: function(data) {
            console.log(data);
            console.log('Status Changed');
            iziToast.success({
                displayMode : 'replace',
                title: 'SUCCESS',
                message: 'Email status changed!',
            });
        }
    });
})