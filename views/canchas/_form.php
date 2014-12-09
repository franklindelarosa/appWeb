<script>
    $(document).ready(function() {
        $('#canchas-estado').val("<?= $model['estado'] ?>");
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
<br>
<div class="col-md-9 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-body"><br>

				<div class="canchas-form">
                    <?php
                    $form = ActiveForm::begin(['id' => 'canchas-form']); ?>

                    <div class="form-group col-md-12">
                        <label for="nombre" class="col-md-2 control-label">Nombre:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $model['nombre'];?>" name="Canchas[nombre]" placeholder="Nombre" required>
                        </div>
                    </div>

                    <?php if(!$model->isNewRecord){ ?>
                    <div class="form-group col-md-12 field-canchas-estado">
                        <label class="col-md-3 control-label">Estado del partido:</label>
                        <div class="col-md-8">
                            <select class="form-control" name="Canchas[estado]" required id="canchas-estado">
                                <option value="">Selecciona un estado</option>
                                <?php foreach($estados as $row){?>
                                    <option value="<?= $row['id_estado'];?>"><?= $row['nombre'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group col-md-12">
                        <label for="direccion" class="col-md-2 control-label">Dirección:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $model['direccion'];?>" name="Canchas[direccion]" placeholder="Dirección" required>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="telefono" class="col-md-2 control-label">Telefono:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $model['telefono'];?>" name="Canchas[telefono]" placeholder="Telefono" required>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="cupo_max" class="col-md-2 control-label">Cupo Máximo:</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" value="<?= $model['cupo_max'];?>" name="Canchas[cupo_max]" placeholder="Cupo Máximo" required>
                        </div>
                    </div>

                    <div class= "form-group col-md-12 text-center">
                            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
