<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Partidos */

$this->title = 'Crear Partido';
$this->params['breadcrumbs'][] = ['label' => 'Partidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p class="btn-right"><a href="<?= Yii::$app->request->baseUrl; ?>/partidos/index" class="btn btn-success">Ver tabla de partidos</a></p>
<div class="partidos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'canchas' =>$canchas,
    ]) ?>

</div>
