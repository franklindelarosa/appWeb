<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p class="btn-right"><a href="<?= Yii::$app->request->baseUrl; ?>/usuarios/index" class="btn btn-default">Volver</a></p>
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>

        <?php if(Yii::$app->user->id != $model->id_usuario){ ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id_usuario], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Está seguro que desea eliminar este item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_usuario',
            'nombre',
            'usuario',
            // 'contrasena',
            ['attribute' => 'sexo', 'value' => $model->sexo === 'f' ? 'Femenino' : 'Masculino'],
            'telefono',
            'correo',
            [
                'attribute' => 'estado',
                'value' => $model->idEstado->nombre,
            ],
        ],
    ]) ?>

</div>
