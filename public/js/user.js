function LoadUsrTbl(search, url = 'usrtrct'){
    $.ajax({
      url: url,
      type:'get',
      data: {
          
      },
      success: function (data) {
          $('#usertransactTable').html(data); 
      }
  });
}
LoadUsrTbl();


// TABLE RELOAD PAGINATE 
$('#usertransactTable').on('click', '.page-link', function(e){
    e.preventDefault();
    LoadUsrTbl('',$(this).attr('href'));
});