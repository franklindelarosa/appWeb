<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Partidos */

$this->title = "Partido: #".$model->id_partido;
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partidos-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p class="btn-right"><a href="<?= Yii::$app->request->baseUrl; ?>/partidos/index" class="btn btn-default">Volver</a></p>
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_partido], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_partido], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea eliminar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_partido',
            'fecha',
            'hora',
            // 'costo',

            // 'venta',
            [
                'attribute' => 'costo',
                'value' => "$ ".number_format($model->costo,0)
            ],
            [
                'attribute' => 'venta',
                'value' => "$ ".number_format($model->venta,0)
            ],
            [
                'attribute' => 'estado',
                'value' => $model->nameEstado(),
            ],
            // 'id_cancha',
            [
                'attribute' => 'id_cancha',
                'value' => $model->nameCancha(),
            ],
            // 'idCancha',
        ],
    ]) ?>

</div>
