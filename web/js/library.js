function loader(){	
	$(".globalMask").hide().ajaxStart(function() {
        $(this).show();
    }).ajaxStop(function() {
        $(this).hide();
    });
    $(".loader").hide().ajaxStart(function() {
        $(this).show();
    }).ajaxStop(function() {
        $(this).hide();
    });
}

function linkView(){
	 $(document).on('click','[class$="grid-view"] table tbody tr',function()
      {
            var url = $(this).children(':last-child()').find('a[title="View"] ').attr('href');
            $(location).attr('href',url);
      });
}