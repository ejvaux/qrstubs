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
        type: "POST",
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

$('.deletebtn').on('click', function(){
    console.log('TEST');
    var form = $('#'+this.id+'_form');
    console.log('#'+this.id+'_form');
    console.log(this.id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.trigger('submit');
        }
    });
})