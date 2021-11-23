function LoadhrTbl(search, url = 'hrc'){
    $.ajax({
      url: url,
      type:'get',
      data: {
          
      },
      success: function (data) {
          $('#hrTable').html(data); 
      }
  });
}
function LoadcreditTbl(search, url = 'crdc'){
    $.ajax({
      url: url,
      type:'get',
      data: {
          
      },
      success: function (data) {
          $('#creditTable').html(data); 
      }
  });
}
LoadhrTbl();
LoadcreditTbl();

$(document).ready(function(){


    // Search user Form
    // $('#searchNForm').on('submit', function(e){

    //     e.preventDefault();

    //     var form = $('#searchNForm').serialize();

    //     LoadhrTbl(form);
    // });

    

    //  EDIT USER FORM
    $('#editModal').on('show.bs.modal', function(event){
    console.log('Model_opened');
    var button = $(event.relatedTarget)

    var emp_id = button.data('myid') 
    var uname = button.data('myuname')
    var email = button.data('myemail')
    var name = button.data('myname')
    var status = button.data('mystatus')
    var department = button.data('mydepartment');
    var modal = $(this)

    modal.find('.modal-body #emp_id').val(emp_id);
    modal.find('.modal-body #email').val(email);
    modal.find('.modal-body #uname').val(uname);
    modal.find('.modal-body #name2').val(name);
    modal.find('.modal-body #status').val(status);
    modal.find('.modal-body #department').val(department);
    
    });

    //  EDIT AMOUNT FORM
    $('#amountModal').on('show.bs.modal', function(event){
        console.log('Model_opened');
        var button = $(event.relatedTarget)
    
        var cred_id = button.data('myid') 
        var name = button.data('myname')
        var ctrl = button.data('myctrl')
        var amount = button.data('myamount')
        var modal = $(this)
    
        modal.find('.modal-body #cred_id').val(cred_id);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #ctrl').val(ctrl);
        modal.find('.modal-body #amount').val(amount);
        });


});

//  REGISTRATION FORM
$('#addUserForm').on('submit', function(e){

    e.preventDefault();

    var form = $('#addUserForm').serialize();
    var url = $(this).attr('action');
    $.ajax({
        url: url,
        type: "POST",
        data: form,
        success: function(data) {
            $("#addUserForm")[0].reset();
            $('#regModal').modal("hide");
            // Load The tables
            LoadhrTbl();
            LoadcreditTbl();

            if (data == 'success') {
                iziToast.success({
                    title: 'Success',
                    position: 'topCenter',
                    message: 'User Registered!'
                });
            }
        },
        error:function(err){
            $('#regModal').modal("hide")
            console.log('ERROR');
            console.log(err);
            console.log(err.responseJSON.message);
            iziToast.warning({
                title: 'Failed',
                position: 'topCenter',
                message: 'User Registration Failed! <br>Please check your input'
            });
        }

    });
});


        //  EDIT FORM BUTTON OVERRIDE
$('#editUserForm').on('submit', function(e){
    e.preventDefault();

    var form = $('#editUserForm').serialize();
    var url = $(this).attr('action');
    $.ajax({
        url: url,
        type: "POST",
        data: form,
        success: function(data) {
            $('#editModal').modal("hide");
            // Load The tables
            LoadhrTbl();
            LoadcreditTbl();

            if (data == 'success') {
                iziToast.success({
                    title: 'Success',
                    position: 'topCenter',
                    message: 'Editting User Success!'
                });
            }
        },
        error:function(error){
            $('#editModal').modal("hide")
            LoadhrTbl();

            iziToast.warning({
                title: 'Failed',
                position: 'topCenter',
                message: 'Editting User Failed!',
            });
        }

    });
});

        //  EDIT AMOUNT BUTTON OVERRIDE
$('#editAmountForm').on('submit', function(e){
    e.preventDefault();

    var form = $('#editAmountForm').serialize();
    var url = $(this).attr('action');
    $.ajax({
        url: url,
        type: "POST",
        data: form,
        success: function(data) {
            $('#amountModal').modal("hide");
            // Load The tables
            LoadcreditTbl();
            
            if (data == 'success') {
                iziToast.success({
                    title: 'Success',
                    position: 'topCenter',
                    message: 'Editting Amount Success!'
                });
            }
        },
        error:function(error){
            // $('#amountModal').modal("hide")

            iziToast.warning({
                title: 'Failed',
                position: 'topCenter',
                message: 'Editting Amount Failed !',
            });
        }

    });
});





//  DELETE FORM BUTTON OVERRIDE
// $('#deleteUserForm').on('submit', function(e){
//     e.preventDefault();

//     var form = $('#deleteUserForm').serialize();
//     var url = $(this).attr('action');
//     $.ajax({
//         url: url,
//         type: "POST",
//         data: form,
//         success: function(data) {
//             $('#deleteModal').modal("hide");
//             LoadhrTbl();

//             if (data == 'success') {
//                 iziToast.warning({
//                     title: 'Deleted User',
//                     position: 'topCenter',
//                     message: 'Successfully!',
//                     iconColor: 'Red',
//                 });
//             }
//         },
//         error:function(error){
//             $('#deleteModal').modal("hide")

//             iziToast.warning({
//                 title: 'Failed',
//                 position: 'topCenter',
//                 message: 'Deleting User Failed !',
//                 color:red,
//             });
//         }

//     });
// });



        



$('#hrTable').on('click', '.page-link', function(e){
    e.preventDefault();
    LoadhrTbl('',$(this).attr('href'));
});
$('#creditTable').on('click', '.page-link', function(e){
    e.preventDefault();
    LoadcreditTbl('',$(this).attr('href'));
});