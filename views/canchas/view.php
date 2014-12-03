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

    <h1><?= Html::encode($this->title) ?></h1><p><img src="http://localhost/futbolcracks/web/images/futbolCracks.png" data-toggle="modal" data-target="#LogoModal" alt="logo" style="width:128px;height:128px"><p>

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
        <a href="#" data-toggle="modal" data-target="#canchaModal" class="btn btn-warning">Foto de la cancha</a>
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

<div id="LogoModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Logo</h4>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <p><img src="http://localhost/futbolcracks/web/images/futbolCracks.png" alt="logo" style="width:128px;height:128px"><p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cambiar imagen</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div id="canchaModal" class="modal fade bs-example-modal-sm" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Cancha</h4>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <p><img src="http://localhost/futbolcracks/web/images/field.png" alt="cancha" style="width:128px;height:128px"><p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cambiar imagen</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>