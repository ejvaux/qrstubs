$(document).ready(function () {
    /*navigator.getUserMedia({
        video: true,
        audio: true
     });*/
    navigator.mediaDevices.getUserMedia(
        {
            video: true
         }
    )
     .then( function(stream){
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                $("#cameraSelect option[value='check']").remove();
                $("#cameraSelect").prop('disabled',false);
                $.each(cameras, function( i,val ) {
                    var opt = document.createElement('option');
                    opt.value = i;
                    opt.text = val.name;
                    $("#cameraSelect").prepend(opt);
                });
                $("#cameraSelect").val(cameras.length-1);
            } else {
                var opt = document.createElement('option');
                    opt.text = "No cameras found.";
                    $("#cameraSelect").append(opt);
                $("#cameraSelect").prop("disabled",true);
                console.error('No cameras found.');
            }
            }).catch(function (e) {
                console.error(e);
        });
     }
     );
    /*navigator.getUserMedia (
        // constraints
        {
           video: true,
           audio: true
        },

        // successCallback
        function(localMediaStream) {
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    $.each(cameras, function( i,val ) {
                        var opt = document.createElement('option');
                        opt.value = i;
                        opt.text = val.name;
                        $("#cameraSelect").prepend(opt);
                    });
                    $("#cameraSelect").val(cameras.length-1);
                } else {
                    var opt = document.createElement('option');
                        opt.text = "No cameras found.";
                        $("#cameraSelect").append(opt);
                    $("#cameraSelect").prop("disabled",true);
                    console.error('No cameras found.');
                }
                }).catch(function (e) {
                    console.error(e);
            });
        },

        // errorCallback
        function(err) {
         if(err === PERMISSION_DENIED) {
           // Explain why you need permission and how to update the permission setting
         }
        }
     );*/

    //$('#msg').text(generateControlNum(new Date()));
});

/* * * * * * FUNCTIONS * * * * * */

function loadcam(i){
    if (i) {
        const args = {
            video: document.getElementById('preview'),
            mirror: false,
        };

        window.URL.createObjectURL = (stream) => {
            args.video.srcObject = stream;
            return stream;
        };
        let scanner = new Instascan.Scanner(args);
        Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[i]);
            $("#scanModal").modal('show');
        }
        else {
            console.error('No cameras found.');
        }
        }).catch(function (e) {
            console.error(e);
        });
        scanner.addListener('scan',function(c){
            loadUser(c);
            scanner.stop().then(function () {
                $("#scanModal").modal('hide');
            });
        });
        $('#scanModal').on('hide.bs.modal', function (event) {
            scanner.stop();
        })
    }
    else{
        iziToast.warning({
            title: 'Warning',
            message: 'Please select camera first.',
            position: 'topCenter',
            close: false,
            pauseOnHover: false,
        });
    }
};

function loadUser(qr){
    /*$.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });*/
    $.ajax({
        url: 'getuser/'+qr,
        type:'GET',
        success: function (data) {
            $("#scanModal").modal('hide');
            if(data){
                $.ajax({
                    url: 'getUserCredit',
                    type:'POST',
                    //global: false,
                    data:{
                        'userId': data.id,
                        'ctrl': generateControlNum(new Date())
                    },
                    success: function (data2) {
                        if (data2) {
                            $('#empId').val(data.id);
                            $('#empNum').val(data.uname);
                            $('#empName').val(data.name);
                            $('#empDept').val(data.department.name);

                            $('#msg').addClass('d-none');
                            $('.scan').removeClass('d-none');
                        } else {
                            reset();
                            Swal.fire({
                                icon: 'error',
                                title: 'User credit not available',
                                text: 'Please contact SPI-IAD Dept.'
                            });
                        }
                    }
                });

            }
            else{
                reset();
                Swal.fire({
                    icon: 'error',
                    title: 'QR Code does not exist in the database.',
                    text: 'Please contact SPI-IAD Dept.'
                });
            }
        }
    });
}

function checkCredit(userId,ctrl){
    $.ajax({
        url: 'getUserCredit',
        type:'POST',
        //global: false,
        data:{
            'userId': userId,
            'ctrl': ctrl
        },
        success: function (data) {
            return data;
        }
    });
}

function transact(userId,ctrl,amount){
    //alert(userId+"-"+ctrl+"-"+amount);

    $.ajax({
        url: 'transact',
        type:'POST',
        //global: false,
        data:{
            'userId': userId,
            'ctrl': ctrl,
            'amount': amount
        },
        success: function (data) {
            /*alert(data);*/
            if(data.status == 1){
                reset();
                Swal.fire({
                    icon: 'success',
                    title: data.result,
                });
            }
            else{
                //reset();
                Swal.fire({
                    icon: 'error',
                    title: data.result,
                    //text: 'Please contact SPI-IAD Dept.'
                });
            }
        }
    });

    /*reset();
    Swal.fire({
        icon: 'success',
        title: 'Transaction Completed.'
    });*/
}

function generateControlNum(date){
    var date = new Date();
    var con = "SPI"+date.getFullYear()+("0"+(date.getMonth()+1)).slice(-2);
    if (date.getDate() <= 15) {
        con = con+"A";
    } else {
        con = con+"B";
    }
    return con;
}
 function reset(){
    $('#msg').removeClass('d-none');
    $('.scan').addClass('d-none');
    $('#amount').removeClass('is-invalid');
    $('#amount').val('0');
    //$('.invalid-feedback').hide();
 }
/* * * * * * EVENTS * * * * * */

$('#scanqrBtn').on('click', function () {
    loadcam($("#cameraSelect").val());
    //$("#scanModal").modal('show');
});

$('#transactBtn').on('click', function (event) {
    empId = $('#empId').val();
    empName = $('#empName').val();
    ctrl = generateControlNum(new Date());
    amnt = $('#amount').val();
    if ($('#amount').val() != 0) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Php "+amnt+" will be deducted to "+empName,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                transact(empId,ctrl,amnt);
            }
        })
        //transact($('#empId').val(),generateControlNum(new Date()),$('#amount').val());
    } else {
        $('#amount').addClass('is-invalid');
    }
})
