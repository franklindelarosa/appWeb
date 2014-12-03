<script>
    $(document).ready(function() {
        $('#canchas-form').bootstrapValidator();
    });
</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;

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
                    <?php $form = ActiveForm::begin(['id' => 'upload-form' ,'options' => ['enctype'=>'multipart/form-data']]);
                    echo $form->field($modeli, 'image')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                    ]);
                    echo Html::submitButton('Submit', ['class'=>'btn btn-primary']);
                    ActiveForm::end();
                    
                    $form = ActiveForm::begin(['id' => 'canchas-form']); ?>

                    <div class="form-group col-md-12">
                        <label for="nombre" class="col-md-2 control-label">Nombre:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $model['nombre'];?>" name="Canchas[nombre]" data-bv-notempty="true" data-bv-notempty-message="El nombre es requerido" placeholder="Nombre">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="direccion" class="col-md-2 control-label">Dirección:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $model['direccion'];?>" name="Canchas[direccion]" data-bv-notempty="true" data-bv-notempty-message="La dirección es requerida" placeholder="Dirección">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="telefono" class="col-md-2 control-label">Telefono:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $model['telefono'];?>" name="Canchas[telefono]" data-bv-notempty="true" data-bv-notempty-message="El teléfono es requerido" placeholder="Telefono">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="cupo_max" class="col-md-2 control-label">Cupo Máximo:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $model['cupo_max'];?>" name="Canchas[cupo_max]" data-bv-notempty="true" data-bv-notempty-message="El cupo máximo es requerido" data-bv-regexp="true" data-bv-regexp-regexp="^[0-9\s]+$" data-bv-regexp-message="Ingrese sólo números" placeholder="Cupo Máximo">
                        </div>
                    </div>

                    <div class= "col-md-12">
                        <div class="form-group col-md-6 text-center">
                            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-success']) ?>
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
