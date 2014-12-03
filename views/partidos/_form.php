<script>
    $(document).ready(function() {
        $('#partidos-estado').val('<?= $model->estado; ?>');
        $('#partidos-id_cancha').val('<?= $model->id_cancha; ?>');
        $('#partidos-fecha').val('<?= $model->fecha; ?>');
        $('#partidos-form').bootstrapValidator().on('error.validator.bv', function(e, data) {
            data.element.data('bv.messages').find('.help-block[data-bv-for="' + data.field + '"]').hide()
            .filter('[data-bv-validator="' + data.validator + '"]').show();
        });
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

            <?php $form = ActiveForm::begin(['id' => 'partidos-form']); ?>
            <div class="form-group col-md-12 field-partidos-fecha required">
                <label class="col-md-3 control-label">Fecha del partido:</label>
                <div class="col-md-8">
                    <?= yii\jui\DatePicker::widget(["id" => "partidos-fecha", "name" => "Partidos[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['data-bv-notempty' => "true", 'data-bv-notempty-message' => "La fecha es requerida", 'data-bv-date' => "true",
                'data-bv-date-format' => "YYYY-MM-DD", 'data-bv-date-message' => "Introduce una fecha válida", 'class' => 'form-control', "placeholder" => "aaaa-mm-dd"]])  ?>
                    <!-- <input value="<?= $model->fecha; ?>" placeholder="aaaa-mm-dd" type="date" id="partidos-fecha" class="form-control" name="Partidos[fecha]"> -->
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-hora">
                <label class="col-md-3 control-label">Hora del partido:</label>
                <div class="col-md-8">
                    <input value="<?= $model->hora; ?>" type="time" id="partidos-hora" class="form-control" name="Partidos[hora]" data-bv-notempty="true" data-bv-notempty-message="La hora es requerida">
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-costo">
                <label class="col-md-3 control-label">Costo del partido:</label>
                <div class="col-md-8">
                    <input value="<?= $model->costo; ?>" type="number" id="partidos-costo" class="form-control" name="Partidos[costo]" data-bv-regexp="true" data-bv-regexp-regexp="^[0-9\s]+$" data-bv-regexp-message="Ingrese sólo números" data-bv-notempty="true" data-bv-notempty-message="El costo del partido es requerido">
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-estado">
                <label class="col-md-3 control-label">Estado del partido:</label>
                <div class="col-md-8">
                    <select class="form-control" name="Partidos[estado]" data-bv-notempty="true" data-bv-notempty-message="El estado es requerido" id="partidos-estado">
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
                    <select class="form-control" name="Partidos[id_cancha]" data-bv-notempty="true" data-bv-notempty-message="La cancha asociada es requerida" id="partidos-id_cancha">
                        <option value="">Selecciona una cancha</option>
                        <?php foreach($canchas as $row){?>
                            <option value="<?= $row['id_cancha'];?>"><?= $row['nombre'];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class= "col-md-12">
                <div class="form-group col-md-12 text-center">
                    <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
