function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}


$("#prnt").on('click', function () {
    /*alert("TAE");*/
    $("#printmodal").modal('show');
    $("#printview").load("/qrstubs/layout");
    /*$("#printview").printThis();*/
});

$("#printNow").on('click', function () {
    printJS({
        printable: 'printview',
        type: 'html',
        targetStyles: ['*']
     })
    /*$("#printview").printThis({
        importCSS: true,
        importStyle: true,
        printContainer: true,
    });*/
    /*$("#printview").print();*/
    /*printDiv("printview");*/
});

