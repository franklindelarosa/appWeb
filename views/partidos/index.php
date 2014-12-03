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

    <p>
        <?= Html::a('Crear Partido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_partido',
            [
                'attribute' => 'fecha',
                'filter' => yii\jui\DatePicker::widget(["name" => "Partidos[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['class' => 'form-control']]),
            ],
            'hora',
            'costo',
            // 'estado',
            [
                'attribute' => 'estado',
                'value' => function($valor){if($valor === '1'){
                                                return 'Disponible para inscripción';}
                                                else{
                                                    if($valor === '2'){
                                                        return 'No disponible para inscripción';}
                                                    else{
                                                        if($valor === '3'){
                                                            return 'Cancelado';}
                                                    }
                                                }
                                            },
                'filter' => ['1' => 'Disponible', '2' => 'No disponible', '3' => 'Cancelado'],
            ],
            // 'id_cancha',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
