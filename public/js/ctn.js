function LoadCtnTbl(search, url = 'ctn'){
    $.ajax({
      url: url,
      type:'get',
      data: {
          
      },
      success: function (data) {
          $('#canteenTable').html(data); 
      }
  });
}
LoadCtnTbl();


// TABLE RELOAD PAGINATE 
$('#canteenTable').on('click', '.page-link', function(e){
    e.preventDefault();
    LoadCtnTbl('',$(this).attr('href'));
});