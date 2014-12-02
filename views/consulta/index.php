<script type="text/javascript">
    $(document).ready(function() {

        $('input[name="ConsultaSearch[Fecha]"]').attr('type', 'date');

        // $("input[name='ConsultaSearch[Fecha]']").datepicker();

        $('#TablaConsulta tr.partido').on('dblclick', function(event) {
            event.preventDefault();
            var data = $(this).attr('data-key');
            $.post('equipos', {id: data}).done(function(data) {
                generarTabla(data[0],'equipoBlanco','Blanco',data[2]-data[0].length);
                generarTabla(data[1],'equipoNegro','Negro',data[2]-data[1].length);
                // console.log(data);
            });
            $('#myModal').modal({backdrop:'static'});
        });

        $('#cuerpoModal').on('dblclick','td', function(event) {
            event.preventDefault();
            var data = $(this).attr('data-id');
            if(data!=null){
                $.post('usuario', {id: data}).done(function(data) {
                    $('#usuarioModal').modal({backdrop:'static'});
                    generarTablaUsuario(data,'infoUsuario');
                    // console.log(data);
                });
            }else{alert('Seleccione un usuario válido')}
        });

    });

    function generarTabla(data,tabla,equipo,n){        
        $('#'+tabla).empty();
        $('#'+tabla).append('<tr><th class="text-center"> Equipo '+equipo+'</th></tr>');
        $.each(data, function(index, val) {
             $('#'+tabla).append('<tr><td data-id='+val['id_usuario']+' class="text-center">'+val['nombre']+'</td></tr>');
        });
        for (var i = 0; i < n; i++) {
            $('#'+tabla).append('<tr><td class="text-center">&nbsp</td></tr>');
        };
    }

    function generarTablaUsuario(data,tabla){
        $('#'+tabla).empty();
        $('#'+tabla).append('<tr><th> Datos de usuario </th></tr>');
        $('#'+tabla).append('<tr><td class="text-center"> Nombre:  '+data['nombre']+'</td></tr>');
        $('#'+tabla).append('<tr><td class="text-center"> Usuario:  '+data['usuario']+'</td></tr>');
        $('#'+tabla).append('<tr><td class="text-center"> Sexo:  '+data['sexo']+'</td></tr>');
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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'id' => 'TablaConsulta',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'partido'],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_cancha',
            ['attribute' => 'Fecha'


            ],
            // 'Fecha',
            'Hora',
            'Cancha',
            'Direccion',
            'Telefono',
            ['attribute' => 'Cupo', 'label' => 'Cupo máximo'],
            // 'Cupo',
            'Total',
            'Blancos',
            'Negros',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<div id="myModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Equipos</h4>
            </div>
            <div id="cuerpoModal" class="modal-body">
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

<div id="usuarioModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Usuario</h4>
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
