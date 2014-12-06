<script type="text/javascript">
    $(document).ready(function() {

        $('#tablaConsulta tr.partido').on('click', function(event) {
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
            var celda = $(this);
            var data = celda.attr('data-id');
            if(data!=null){
                $.post(celda.attr('data-entidad'), {id: data}).done(function(data) {
                    generarTablaUsuario(data);
                    $('#usuarioModal').modal();
                });
            }else{
                $('.helper').val(celda.attr('data-equipo'));
                $('#cuerpoModal td').removeClass('currentPlayer');
                $(this).addClass('currentPlayer');
                $('#invitacionModal').modal({backdrop:'static'});
            }
        });

        $('#btnRegistrado').on('click', function(event) {
            event.preventDefault();
            generarInvitacion('registrarregistrado', $('#form-registrado').serialize());
        });

        $('#btnInvitado').on('click', function(event) {
            event.preventDefault();
            generarInvitacion('registrarinvitado', $('#form-invitado').serialize());
        });

        $('#equiposModal').on('hidden.bs.modal', function(event) {
            $('#equipoBlanco').empty();
            $('#equipoNegro').empty();
        });

        $('#usuarioModal').on('hidden.bs.modal', function(event) {
            $('#infoUsuario').empty();
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

    function generarInvitacion(action, data){
        $.post(action, {data: data}).done(function(data){
            $('#cuerpoModal td.currentPlayer').html(data['nombre']);
            $('#cuerpoModal td.currentPlayer').attr({
                "style": 'color:green',
                "data-id": data['id'],
                "data-entidad": data['entidad']
            });
        });
    }

    function generarTabla(data,tabla,equipo,n){
        $('#'+tabla).empty();
        $('#'+tabla).append('<tr><th class="text-center"> Equipo '+equipo+'</th></tr>');
        $.each(data, function(index, val) {
            $.each(val, function(i, v) {
                if (index == 0){
                    $('#'+tabla).append('<tr><td style="color:green" data-entidad="usuario" data-equipo="'+equipo+'" data-id='+v['id_usuario']+' class="text-center">'+v['nombre']+'</td></tr>');
                }else{
                    $('#'+tabla).append('<tr><td style="color:green" data-entidad="invitado" data-equipo="'+equipo+'" data-id='+v['id_invitado']+' class="text-center">'+v['nombre']+'</td></tr>');
                }
            });
        });
        for (var i = 0; i < n; i++) {
            $('#'+tabla).append('<tr><td data-equipo="'+equipo+'" style="color:blue" class="text-center">Invitar</td></tr>');
        };
    }

    function generarTablaUsuario(data){
        $('#infoUsuario').empty();
        $('#infoUsuario').append('<tr><th class="text-center"> Datos del jugador </th></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Nombre: '+data['nombre']+'</td></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Correo: '+data['correo']+'</td></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Sexo: '+data['sexo']+'</td></tr>');
        $('#infoUsuario').append('<tr><td class="text-center"> Teléfono: '+data['telefono']+'</td></tr>');
    }
</script>

<?php

use yii\helpers\Html;
use yii\grid\GridView;


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
    
    <?= GridView::widget([
        'id' => 'tablaConsulta',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'partido'],
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

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
                                                <select name="usuario" data-live-search="true" data-width="100%" class="selectpicker" required>
                                                    <option value="">Selecciona a un usuario</option>
                                                    <?php foreach($usuarios as $row){?>
                                                        <option value="<?= $row['id_usuario'];?>"><?= $row['correo'];?></option>
                                                    <?php }?>
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
                                            <label for="nombre" class="col-md-3 control-label">Nombre:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="correo" class="col-md-3 control-label">Correo:</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="sexo" class="col-md-3 control-label">Sexo:</label>
                                            <div class="col-md-9">
                                                <select name="sexo" class="form-control" required>
                                                    <option value="">Selecciona el sexo</option>
                                                    <option value="m">Masculino</option>
                                                    <option value="f">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="telefono" class="col-md-3 control-label">Teléfono:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="telefono" placeholder="Teléfono" required>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
