<script type="text/javascript">
    $(document).ready(function() {
        linkView();
    });

</script>
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
        <?= Html::a('Crear Usuarios', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </p>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => ['class' => 'text-center'],
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],

                // 'id_usuario',
                'nombres',
                'apellidos',
                'correo',
                // 'usuario',
                // 'contrasena',
                'telefono',
                // 'sexo',
                ['attribute' => 'sexo',
                'value' => function($dato){ if($dato['sexo'] === 'f'){return 'Femenino';}else{return 'Masculino';}},
                'filter' => ['m' => 'Masculino', 'f' => 'Femenino'],
                ],
                [
                    'attribute' => 'estado',
                    'value' => function($valor){
                        switch ($valor->estado) {
                            case '4':
                                return 'Activo';
                                break;
                            case '5':
                                return 'Inactivo';
                            case '8':
                                return 'Bloqueado';
                            case '9':
                            return 'Sin verificar';
                                break;
                        }
                },
                    'filter' => ['4' => 'Activo', '5' => 'Inactivo', '8' => 'Bloqueado', '9' => 'Sin verificar'],
                ],

                 [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['hidden' => ''],
                    'headerOptions' => ['hidden' => ''],
                    'filterOptions' => ['hidden' => ''],
                ],
            ],
        ]); ?>
    </div>

</div>
