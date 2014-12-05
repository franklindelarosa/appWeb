<script type="text/javascript">
    $(document).ready(function() {        
       linkView();
    });
</script>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            // 'estado',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['hidden' => ''],
                'headerOptions' => ['hidden' => ''],
                'filterOptions' => ['hidden' => ''],
            ],

        ],
        
    ]); ?>

</div>
