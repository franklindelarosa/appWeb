function success(mensaje,num){

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    }
    switch(num){
        case '1': toastr.success(mensaje);break;
        case '2': toastr.warning(mensaje);break;
        case '3': toastr.error(mensaje);break;
        case '4': toastr.info(mensaje);break;
    }
}

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