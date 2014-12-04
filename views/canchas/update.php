<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Canchas */

$this->title = 'Actualizar Canchas: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Canchas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cancha, 'url' => ['view', 'id' => $model->id_cancha]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="canchas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'estados' => $estados,
    ]) ?>

</div>
