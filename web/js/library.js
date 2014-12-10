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

function generarInvitacion(action, data){
        $.post(action, {data: data}).done(function(data){
            if(data['mensaje'] == 'ok'){
                $('#cuerpoModal td.currentPlayer').html(data['nombre']);
                $('#cuerpoModal td.currentPlayer').attr({
                    "style": 'color:green',
                    "data-id": data['id'],
                    "data-entidad": data['entidad']
                });
            }
        });
    }