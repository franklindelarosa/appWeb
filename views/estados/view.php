<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estados */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Estados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-view">

    <h1><?= Html::encode($this->title) ?></h1><br>
    
    <p class="btn-right"><a href="<?= Yii::$app->request->baseUrl; ?>/estados/index" class="btn btn-default">Volver</a></p>
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_estado], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_estado], [
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
            // 'id_estado',
            'nombre',
            'entidad',
            'descripcion',
        ],
    ]) ?>

</div>
