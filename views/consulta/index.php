<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#tablaConsulta tr.partido',function(event) {
            event.preventDefault();
            partido = $(this).attr('data-key');
            $.post('equipos', {id: partido}).done(function(data) {
                generarTabla(data[0],'equipoBlanco','Blanco',(data[2][0]['max']/2)-(data[0][0].length+data[0][1].length));
                generarTabla(data[1],'equipoNegro','Negro',(data[2][0]['max']/2)-(data[1][0].length+data[1][1].length));
                $('#equiposModal').modal({backdrop:'static'});
            });
        });

        $('#cuerpoModal').on('click','td', function(event) {
            event.preventDefault();
            $('.helper2').val(partido);
            $('#cuerpoModal td').removeClass('currentPlayer');
            $(this).addClass('currentPlayer');
            var celda = $(this);
            var data = celda.attr('data-id');
            if(data!=null){
                $.post(celda.attr('data-entidad'), {id: data, partido: partido}).done(function(data) {
                    generarTablaUsuario(data);
                    $('#usuarioModal').modal();
                });
            }else{
                $('.helper').val(celda.attr('data-equipo'));
                $('#invitacionModal').modal({backdrop:'static'});
            }
        });

        $('#btnRegistrado').on('click', function(event) {
            event.preventDefault();
            if($('#usuario').val() === ''){
                success('Debes seleccionar un usuario','3');
            }else{
                generarInvitacion('registrarregistrado', $('#form-registrado').serialize());
            }
        });

        $('#btnInvitado').on('click', function(event) {
            event.preventDefault();
            var enviar = true;
            console.log($('#form-invitado').serialize());
            $.each($('.campo'), function(index, val) {
                if(val.value.trim().length == 0){
                    success('No puedes dejar campos sin llenar','3');
                    enviar = false;
                    return false;
                }
            });
            enviar ? generarInvitacion('registrarinvitado', $('#form-invitado').serialize()) : '';
        });

        $('#btnSacar').on('click', function(event) {
            event.preventDefault();
            var invitados = $('#cuerpoModal td[data-entidad = "invitado"]');
            var current = $('#cuerpoModal td.currentPlayer');
            $.post('sacarjugador', {jugador: current.attr('data-id'), entidad: current.attr('data-entidad'), equipo: current.attr('data-equipo'), partido: partido}).done(function(data){
                if(data['mensaje'] === 'ok'){
                    restaurarCelda(current);
                    if(typeof(data['invitados']) != "undefined" && data['invitados'] !== null) {
                        $.each(data['invitados'], function(index, val) {
                            celda = $('#cuerpoModal td[data-id = "'+val['id_invitado']+'"]');
                            restaurarCelda(celda);
                        });
                    }
                }
            });
        });

        $('#btnConfirmar').on('click', function(event) {
            event.preventDefault();
            $('#confirmacionModal').modal({backdrop:'static'});
        });

        $('#equiposModal').on('hidden.bs.modal', function(event) {
            $('#equipoBlanco').empty();
            $('#equipoNegro').empty();
            $.pjax.reload({container: '#tablaConsulta'});
        });

        $('#usuarioModal').on('hidden.bs.modal', function(event) {
            $('#infoUsuario').empty();
        });

        $('#invitacionModal').on('show.bs.modal', function(event) {
            $.post('listadousuarios', {id: partido}).done(function(data){
                generarListadoUsuarios(data);
            });
        });

        $('#invitacionModal').on('hidden.bs.modal', function(event) {
            $('#form-registrado')[0].reset();
            $('#form-invitado')[0].reset();
            $('.selectpicker').selectpicker('refresh');
        });

        $(document).ajaxStart(function() {
            $('.globalMask').show();
        }).ajaxStop(function() {
            $('.globalMask').hide();
        });
        $(document).ajaxStart(function() {
            $(".loader").show();
        }).ajaxStop(function() {
            $(".loader").hide();
        });
    });

    function generarTabla(data,tabla,equipo,n){
        $('#'+tabla).empty();
        $('#'+tabla).append('<tr><th class="text-center"> Equipo '+equipo+'</th></tr>');
        $.each(data, function(index, val) {
            $.each(val, function(i, v) {
                if (index == 0){
                    $('#'+tabla).append('<tr><td data-entidad="usuario" data-equipo="'+equipo+'" data-id='+v['id_usuario']+' class="text-center user-color">'+v['nombre']+'</td></tr>');
                }else{
                    $('#'+tabla).append('<tr><td data-entidad="invitado" data-equipo="'+equipo+'" data-id='+v['id_invitado']+' class="text-center guest-color">'+v['nombre']+'</td></tr>');
                }
            });
        });
        for (var i = 0; i < n; i++) {
            $('#'+tabla).append('<tr><td data-equipo="'+equipo+'" class="text-center free-color">Invitar (cupo libre)</td></tr>');
        };
    }

    function restaurarCelda(celda){
        celda.html('Invitar (cupo libre)');
        celda.removeClass();
        celda.addClass('text-center free-color');
        celda.removeAttr('data-id');
        celda.removeAttr('data-entidad');
    }

    function calcular_edad(fecha) {
        var values = fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth()+1;
        var ahora_dia = fecha_hoy.getDate();
        var edad = (ahora_ano + 1900) - ano;
        if (ahora_mes < mes){
            edad--;
        }
        if ((mes === ahora_mes) && (ahora_dia < dia)){
            edad--;
        }
        if (edad > 1900){
            edad -= 1900;
        }
        return edad;
    }

    function generarTablaUsuario(data){
        $('#infoUsuario').empty();
        $('#infoUsuario').append('<tr><th class="text-center"> Datos del jugador </th></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Nombre: '+data['nombre']+'</td></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Correo: '+data['correo']+'</td></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Sexo: '+data['sexo']+'</td></tr>');
        data['fecha_nacimiento'] !== null ? $('#infoUsuario').append('<tr><td class="text-center"> Edad: '+calcular_edad(data['fecha_nacimiento'])+'</td></tr>')
        : $('#infoUsuario').append('<tr><td class="text-center"> Edad: Sin definir</td></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Teléfono: '+data['telefono']+'</td></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Posición: '+data['posicion']+'</td></tr>');
        data['pierna_habil'] !== null ? $('#infoUsuario').append('<tr><td class="text-center"> Pierna hábil: '+data['pierna_habil']+'</td></tr>')
        : $('#infoUsuario').append('<tr><td class="text-center"> Pierna hábil: Sin definir</td></tr>');
        if(typeof(data['responsable']) != "undefined" && data['responsable'] !== null) {
            $('#infoUsuario').append('<tr><td></td></tr>');
            $('#infoUsuario').append('<tr><td class="text-center"> Responsable: '+data['responsable']+'</td></tr>');
            $('#infoUsuario').append('<tr><td class="text-center"> Tel. Responsable: '+data['tel']+'</td></tr>');
        }
    }

    function generarListadoUsuarios(data){
        $('#usuario').empty();
        $('#usuario').append('<option value="">Selecciona a un usuario</option>');
        $.each(data, function(index, val) {
            $('#usuario').append('<option value="'+val['id_usuario']+'">'+val['nombre']+'</option>');
        });
        $('#usuario').selectpicker('refresh');
    }

    function generarInvitacion(action, data){
        $.post(action, {data: data}).done(function(data){
            if(data['mensaje'] === 'ok'){
                celda = $('#cuerpoModal td.currentPlayer');
                celda.html(data['nombre']);
                celda.attr({
                    "data-id": data['id'],
                    "data-entidad": data['entidad']
                });
                var clase;
                data['entidad'] === 'invitado' ? clase = "text-center guest-color" : clase = "text-center user-color";
                celda.removeClass();
                celda.addClass(clase);
            }
        });
    }
</script>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\CanchasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consulta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canchas-index">

    <div class="globalMask">
        <div class="loader toolbar"></div>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p class="btn-right"><a class="btn btn-primary btn-lg" href="index">Limpiar filtros</a></p>
<div class="table-responsive">
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'id' => 'tablaConsulta',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'partido text-center'],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_cancha',
            // 'Fecha',
            [
                'attribute' => 'Fecha',
                'filter' => yii\jui\DatePicker::widget(["name" => "ConsultaSearch[Fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['class' => 'form-control']]),
            ],
            'Hora',
            'Cancha',
            // 'Direccion',
            // 'Telefono',
            ['attribute' => 'Cupo', 'label' => 'Cupo máximo'],
            // 'Cupo',
            // 'Total',
            ['attribute' => 'Total', 'label' => 'Cupos reservados'],
            // 'Blancos',
            ['attribute' => 'Blancos', 'label' => 'Equipo blanco'],
            // 'Negros',
            ['attribute' => 'Negros', 'label' => 'Equipo negro'],
            [
                'headerOptions' => ['width' => '15%'],
                'attribute' => 'Estado',
                'value' => function($valor){
                    switch ($valor->Estado) {
                        case '1':
                            return 'Disponible';
                            break;
                        case '2':
                            return 'No disponible';
                            break;
                        case '3':
                            return 'Cancelado';
                            break;
                    }
            },
                'filter' => ['1' => 'Disponible', '2' => 'No disponible', '3' => 'Cancelado'],
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

</div>

<div id="equiposModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Equipos</h4>
            </div>
            <div id="cuerpoModal" class="modal-body col-md-12">
                <table id="equipoBlanco" class="tablaModal table table-striped table-bordered table-hover">
                </table>
                <table id="equipoNegro" class="tablaModal table table-striped table-bordered table-hover">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div id="usuarioModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Jugador</h4>
            </div>
            <div class="modal-body">
                <table id="infoUsuario" class="table table-striped table-bordered table-hover">
                </table>
                <button id="btnConfirmar" data-dismiss="modal" class="btn btn-danger col-sm-offset-3">Sacar del partido</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div id="confirmacionModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-center">Seguro que deseas sacarlo del partido?</h4>
            </div>
            <div class="modal-body">
                <button id="btnSacar" data-dismiss="modal" class="btn btn-danger col-sm-offset-3">Si</button>
                <button data-dismiss="modal" class="btn btn-primary col-sm-offset-3">No</button>
            </div>
        </div>
    </div>
</div>

<div id="invitacionModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">A quién deseas invitar?</h4>
            </div>
            <div class="modal-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title text-center">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Jugador registrado en la aplicación
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <form id="form-registrado" method="post" role="form">
                                    <div class="form-group col-md-12">
                                        <label for="usuario" class="col-md-2 control-label">Usuario:</label>
                                        <div class="col-md-10">
                                            <select id="usuario" name="usuario" data-live-search="true" data-width="100%" class="selectpicker" required>
                                                <option value="">Selecciona a un usuario</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input hidden class="helper" type="text" name="equipo" required>
                                    <input hidden class="helper2" type="text" name="partido" required>
                                    <div class="form-group col-md-7 col-md-offset-4">
                                        <button id="btnRegistrado" type="submit" data-dismiss="modal" class="btn btn-success">Añadir jugador</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title text-center">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Jugador no registrado aún
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <form id="form-invitado" method="post" role="form">
                                        <div class="form-group col-md-12">
                                            <label for="nombre" class="col-md-3 control-label">Nombre(s):</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control campo" name="nombres" placeholder="Nombre(s)" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="apellido" class="col-md-3 control-label">Apellido(s):</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control campo" name="apellidos" placeholder="Apellido(s)" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="fecha_nacimiento" class="col-md-3 control-label">Fecha de nacimiento:</label>
                                            <div class="col-md-9">
                                                <?= yii\jui\DatePicker::widget(["id" => "fecha_nacimiento", "name" => "fecha_nacimiento", "dateFormat" => "yyyy-MM-dd", 'options' => ['class' => 'form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['yearRange' => $rango_fecha, 'changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="correo" class="col-md-3 control-label">Correo:</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control campo" name="correo" placeholder="Correo electrónico" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="sexo" class="col-md-3 control-label">Sexo:</label>
                                            <div class="col-md-9">
                                                <select name="sexo" class="form-control campo" required>
                                                    <option value="">Selecciona el sexo</option>
                                                    <option value="m">Masculino</option>
                                                    <option value="f">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="telefono" class="col-md-3 control-label">Teléfono:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control campo" name="telefono" placeholder="Teléfono" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="pierna_habil" class="col-md-3 control-label">Pierna hábil:</label>
                                            <div class="col-md-9">
                                                <select id="pierna_habil" name="pierna_habil" class="form-control">
                                                    <option value="">Sin definir</option>
                                                    <option value="Derecha">Derecha</option>
                                                    <option value="Izquierda">Izquierda</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="posicion" class="col-md-3 control-label">Posición:</label>
                                            <div class="col-md-9">
                                                <select id="posicion" name="posicion" class="form-control">
                                                    <?php foreach($posiciones as $row){?>
                                                        <option value="<?= $row['id_posicion'];?>"><?= $row['posicion'];?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <input hidden class="helper" type="text" name="equipo" required>
                                        <input hidden class="helper2" type="text" name="partido" required>
                                        <div class="form-group">
                                            <div class="checkbox col-md-10 col-md-offset-1">
                                                <label>
                                                    <input type="checkbox" name="bool"> Registrar usuario?
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-7 col-md-offset-4">
                                            <button id="btnInvitado" type="submit" data-dismiss="modal" class="btn btn-success">Añadir invitado</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                      </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
