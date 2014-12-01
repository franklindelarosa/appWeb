<script type="text/javascript">
    $(document).ready(function() {
        $('tr').on('dblclick', function(event) {
            event.preventDefault();
            $('#myModal').modal({backdrop:'static'});
        });
    });
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
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_cancha',
            'Fecha',
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
            <div class="modal-body">
                <table id="tableDetalle" class="table table-responsive table-striped table-hover">
                    <tr>
                        <th>Equipo Blanco</th>
                        <th>Equipo Negro</th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
