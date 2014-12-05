<script>
    $(document).ready(function() {
        $('#estados-entidad').val("<?= $model['entidad'] ?>");
    });
</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Estados */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-body"><br>
			<div class="estados-form">

				<?php $form = ActiveForm::begin(); ?>

				<div class="form-group col-md-12">
					<label for="nombre" class="col-md-3 control-label">Nombre:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" value="<?= $model['nombre'];?>" name="Estados[nombre]" placeholder="Nombre" required>
					</div>
				</div>

				<div class="form-group col-md-12">
					<label for="entidad" class="col-md-3 control-label">Entidad:</label>
					<div class="col-md-9">
						<select class="form-control" name="Estados[entidad]" required id="estados-entidad">
                        <option value="">Selecciona una entidad</option>
                        <option value="partidos">Partidos</option>
                        <option value="usuarios">Jugadores</option>
                        <option value="canchas">Canchas</option>
                    </select>
						<p class="help-block">A qué entidad pertenecerá el estado.</p>
					</div>
				</div>

				<div class="form-group col-md-12">
					<label for="descripcion" class="col-md-3 control-label">Descripción:</label>
					<div class="col-md-9">
						<!-- <input type="text" class="form-control" value="<?= $model['descripcion'];?>" name="Estados[descripcion]" placeholder="Descripción" required> -->
						<textarea name="Estados[descripcion]" placeholder="Descripción" class="form-control" rows="1"><?= $model['descripcion'];?></textarea>
					</div>
				</div>

				<div class= "col-md-12">
                    <div class="form-group col-md-6 text-center">
                        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-success']) ?>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <a href="index" class="btn btn-primary">Volver</a>
                    </div>
                </div>

				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</div>
