$(document).ready(function () {

    // $("#uname").keyup(function () {
    //   var value = $(this).val() ;
    //   $("#qrcode").val(value);
    // });

    $('input[type="radio"]').click(function () {
      var inputValue = $(this).attr("value");
      var target = $("." + inputValue);
      $(".select").not(target).hide();
      $(target).show();
    });

    
  });