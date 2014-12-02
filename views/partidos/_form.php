<script>
    $(document).ready(function() {
        $('#partidos-estado').val('<?= $model->estado; ?>');
        $('#partidos-id_cancha').val('<?= $model->id_cancha; ?>');
        $('#partidos-fecha').val('<?= $model->fecha; ?>');
    });
</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Partidos */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="partidos-form">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Registrar perfil</h3>
            </div>
            <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>
            <div class="form-group col-md-12 field-partidos-fecha required">
                <label class="col-md-3 control-label">Fecha del partido:</label>
                <div class="col-md-8">
                    <?= yii\jui\DatePicker::widget(["id" => "partidos-fecha", "name" => "Partidos[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['class' => 'form-control', "placeholder" => "aaaa-mm-dd"]])  ?>
                    <!-- <input value="<?= $model->fecha; ?>" placeholder="aaaa-mm-dd" type="date" id="partidos-fecha" class="form-control" name="Partidos[fecha]"> -->
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-hora required">
                <label class="col-md-3 control-label">Hora del partido:</label>
                <div class="col-md-8">
                    <input value="<?= $model->hora; ?>" type="time" id="partidos-hora" class="form-control" name="Partidos[hora]">
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-costo required">
                <label class="col-md-3 control-label">Costo del partido:</label>
                <div class="col-md-8">
                    <input value="<?= $model->costo; ?>" type="number" id="partidos-costo" class="form-control" name="Partidos[costo]" maxlength="10">
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-estado required">
                <label class="col-md-3 control-label">Estado del partido:</label>
                <div class="col-md-8">
                    <select class="form-control" name="Partidos[estado]" id="partidos-estado">
                        <option value="">Selecciona un estado</option>
                        <option value="1">Disponible para inscripción</option>
                        <option value="2">No disponible para inscripción</option>
                        <option value="3">Cancelado</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-id_cancha required">
                <label class="col-md-3 control-label">Cancha:</label>
                <div class="col-md-8">
                    <select class="form-control" name="Partidos[id_cancha]" id="partidos-id_cancha">
                        <option value="">Selecciona una cancha</option>
                        <?php foreach($canchas as $row){?>
                            <option value="<?= $row['id_cancha'];?>"><?= $row['nombre'];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class= "col-md-12">
                <div class="form-group col-md-12 text-center">
                    <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['ng-disabled'=>'formulario.$invalid', 'class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <!--<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <?= $form->field($model, 'costo')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'id_cancha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>-->

</div>
