<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Partidos */

$this->title = 'Update Partidos: ' . ' ' . $model->id_partido;
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_partido, 'url' => ['view', 'id' => $model->id_partido]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="partidos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
