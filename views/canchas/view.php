<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Canchas */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Canchas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canchas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn-right"><a href="<?= Yii::$app->request->baseUrl; ?>/canchas/index" class="btn btn-default">Volver</a></p>
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_cancha], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_cancha], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea borrar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_cancha',
            'nombre',
            'direccion',
            'telefono',
            'cupo_max',
        ],
    ]) ?>

</div>
