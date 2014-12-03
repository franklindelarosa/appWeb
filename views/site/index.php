<?php
/* @var $this yii\web\View */
$this->title = 'Futbol Cracks';
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4 text-center">
                <div class="col-lg-10">
                    <h2><label class="control-label text-center">Canchas</label></h2>
                    <p class="text-center"><a class="btn" href="canchas/index"><img class="img-responsive" src="<?= Yii::$app->request->baseUrl.'/images/field.png' ?>" alt="Cancha"></a></p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="col-lg-10">
                    <h2><label class="control-label">Crear partido</label></h2>
                    <p class="text-center"><a class="btn" href="partidos/create"><img class="img-responsive" src="<?= Yii::$app->request->baseUrl.'/images/ball.png' ?>" alt="Partido"></a></p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="col-lg-10">
                    <h2><label class="control-label">Consulta</label></h2>
                    <p class="text-center"><a class="btn" href="consulta/index"><img class="img-responsive" src="<?= Yii::$app->request->baseUrl.'/images/statistics.png' ?>" alt="Consulta"></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
