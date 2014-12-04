<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn-right">
        <?= Html::a('Crear Usuarios', ['create'], ['class' => 'btn btn-success  btn-lg']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_usuario',
            'nombre',
            'usuario',
            // 'contrasena',
            // 'sexo',
            ['attribute' => 'sexo',
            'value' => function($sexo){ if($sexo === 'f'){return 'Femenino';}else{return 'Masculino';}},
            'filter' => ['m' => 'Masculino', 'f' => 'Femenino'],
            ],
            // 'telefono',
            // 'correo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
