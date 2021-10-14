$('.editbtn').on('click', function () {
    alert("TEST");
    alert($(this).data('arr').name);
    $("#editModal").modal('show');
});