<?php

/* @var $this yii\web\View */

$this->title = 'Futbol Cracks';
?>

<div class="site-index">



    <div class="body-content" style="padding:3% 0">

        <div class="col-lg-12" style="padding:5% 0">

            <div class="col-lg-4 text-center">

                <a class="botones" href="canchas/index">

                    <div class="col-lg-10 contenedor-btn">

                        <h2 class="text-center">Canchas</h2><img class="img-botones" src="<?= Yii::$app->request->baseUrl.'/images/field.png' ?>" alt="Cancha">

                    </div>

                </a>

            </div>

            <div class="col-lg-4 text-center">

                <a class="botones" href="partidos/create">

                    <div class="col-lg-10 contenedor-btn">

                        <h2 class="text-center">Partidos</h2>

                        <img class="img-botones" src="<?= Yii::$app->request->baseUrl.'/images/ball.png' ?>" alt="Partido">

                    </div>

                </a>

            </div>

            <div class="col-lg-4 text-center">

                <a class="botones" href="consulta/index">

                    <div class="col-lg-10 contenedor-btn">

                        <h2 class="text-center">Consulta</h2>

                        <img class="img-botones" src="<?= Yii::$app->request->baseUrl.'/images/statistics.png' ?>" alt="Consulta">

                    </div>

                </a>

            </div>

        </div>

    </div>

</div>

