<script type="text/javascript">
    $(document).on('click','[class$="grid-view"] table tbody tr',function()
    {
        var url = $(this).children(':last-child()').find('a[tittle=View] ').attr('href');
        $(location).attr('href',url);
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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn-right">
        <?= Html::a('Crear Cancha', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id_cancha',
            'nombre',
            'direccion',
            'telefono',
            'cupo_max',

            ['class' => 'yii\grid\ActionColumn'],

        ],
        
    ]); ?>

</div>
