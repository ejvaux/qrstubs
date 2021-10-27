function LoadhrTbl(search, url = 'users'){
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
LoadUsrTbl();

$('#hrTable').on('click', '.page-link', function(e){
    e.preventDefault();
    LoadhrTbl('',$(this).attr('href'));
});