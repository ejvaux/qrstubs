function LoadUsrTbl(search, url = 'usr'){
    $.ajax({
      url: url,
      type:'get',
      data: {
          
      },
      success: function (data) {
          $('#transactionTable').html(data); 
      }
  });
}
LoadUsrTbl();

$('#transactionTable').on('click', '.page-link', function(e){
    e.preventDefault();
    LoadUsrTbl('',$(this).attr('href'));
});