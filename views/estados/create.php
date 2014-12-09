<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estados */

$this->title = 'Create Estados';
$this->params['breadcrumbs'][] = ['label' => 'Estados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p class="btn-right"><a href="<?= Yii::$app->request->baseUrl; ?>/estados/index" class="btn btn-lg btn-success">Listar estados</a></p>
<div class="estados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
