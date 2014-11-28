<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Canchas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-9 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Canchas</h3>
            </div>
            <div class="panel-body">

				<div class="canchas-form">

				    <?php $form = ActiveForm::begin(); ?>

				    <!-- <?= $form->field($model, 'nombre')->textInput(['maxlength' => 45]) ?> -->

				    <!-- <?= $form->field($model, 'direccion')->textInput(['maxlength' => 45]) ?> -->

				    <!-- <?= $form->field($model, 'telefono')->textInput(['maxlength' => 45]) ?> -->

				    <!-- <?= $form->field($model, 'cupo_max')->textInput() ?> -->

				    <div class="form-group col-md-12">
                        <label for="nombre" class="col-md-2 control-label">Nombre:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="Canchas[nombre]" placeholder="Nombre">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="direccion" class="col-md-2 control-label">Dirección:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="Canchas[direccion]" placeholder="Dirección">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="telefono" class="col-md-2 control-label">Telefono:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="Canchas[telefono]" placeholder="Telefono">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="cupo_max" class="col-md-2 control-label">Cupo Máximo:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="Canchas[cupo_max]" placeholder="Cupo">
                        </div>
                    </div>

				    <div class= "col-md-12">
                        <div class="form-group col-md-6 text-center">
                            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
                        </div>
                        <div class="form-group col-md-6 text-center">
                            <a href="<?= Yii::$app->request->baseUrl; ?>/canchas/index" class="btn btn-primary">Volver</a>
                        </div>
                    </div>

				    <?php ActiveForm::end(); ?>

				</div>
			</div>
		</div>
	</div>