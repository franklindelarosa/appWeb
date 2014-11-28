<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Canchas */

$this->title = 'Crear Cancha';
$this->params['breadcrumbs'][] = ['label' => 'Canchas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canchas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
