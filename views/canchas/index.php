<script type="text/javascript">
    $(document).ready(function() {
       linkView();
    });
</script>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CanchasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Canchas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canchas-index">

    <div class="globalMask">
            <div class="loader"></div>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn-right">
        <?= Html::a('Crear Cancha', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </p>
   <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'text-center'],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_cancha',
            
            'nombre',
            'direccion',
            'telefono',
            'cupo_max',
            [
                'attribute' => 'estado',
                'value' => function($valor){
                    switch ($valor->estado) {
                        case '6':
                            return 'Activa';
                            break;
                        case '7':
                            return 'Inactiva';
                            break;
                    }
            },
                'filter' => ['6' => 'Activa', '7' => 'Inactiva'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['hidden' => ''],
                'headerOptions' => ['hidden' => ''],
                'filterOptions' => ['hidden' => ''],
            ],

        ],
        
    ]); ?>
    <?php Pjax::end(); ?>

</div>
