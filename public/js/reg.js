$(document).ready(function () {
    $('input[type="radio"]').click(function () {
    var inputValue = $(this).attr("value");
    var target = $("." + inputValue);
    $(".select").not(target).hide();
    $(target).show();
    });
});