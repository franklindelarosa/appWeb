<script type="text/javascript">
    $(document).ready(function() {        
        linkView();
    });

</script>
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartidosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Partidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partidos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn-right">
        <?= Html::a('Crear Partido', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_partido',
            // 'fecha',
            [
                'attribute' => 'fecha',
                'filter' => yii\jui\DatePicker::widget(["name" => "PartidosSearch[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['class' => 'form-control']]),
            ],
            'hora',
            // 'costo',
            [
                'attribute' => 'costo',
                'value' => function($data){ return "$ ".number_format($data->costo,0);}
            ],
            [
                'attribute' => 'venta',
                'value' => function($data){ return "$ ".number_format($data->venta,0);}
            ],
            // 'estado',
            [
                'attribute' => 'estado',
                'value' => function($valor){
                    switch ($valor->estado) {
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
            'id_cancha',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['hidden' => ''],
                'headerOptions' => ['hidden' => ''],
                'filterOptions' => ['hidden' => ''],
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
