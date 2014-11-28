<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <p class="text-center"><a class="btn" href=""><img class="img-responsive" src="<?= Yii::$app->request->baseUrl.'/images/field.png' ?>" alt="Cancha"></a></p>
            </div>
            <div class="col-lg-4">
                <p class="text-center"><a class="btn" href=""><img class="img-responsive" src="<?= Yii::$app->request->baseUrl.'/images/ball.png' ?>" alt="Partido"></a></p>
            </div>
            <div class="col-lg-4">
                <p class="text-center"><a class="btn" href=""><img class="img-responsive" src="<?= Yii::$app->request->baseUrl.'/images/statistics.png' ?>" alt="Consulta"></a></p>
            </div>
        </div>

    </div>
</div>
