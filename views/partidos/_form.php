<script>
    $(document).ready(function() {
        $('#partidos-estado').val('<?= $model->estado; ?>');
        $('#partidos-id_cancha').val('<?= $model->id_cancha; ?>');
        $('#partidos-fecha').val('<?= $model->fecha; ?>');
        $('#partidos-estado').val('<?= $model->estado; ?>');
    });
</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Partidos */
/* @var $form yii\widgets\ActiveForm */
?>


<br>
<div class="partidos-form">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-primary">
            <br>
            <div class="panel-body">

            <?php $form = ActiveForm::begin(['id' => 'partidos-form']); ?>
            <div class="form-group col-md-12 field-partidos-fecha required">
                <label class="col-md-4 control-label">Fecha del partido:</label>
                <div class="col-md-8">
                    <?= yii\jui\DatePicker::widget(["id" => "partidos-fecha", "name" => "Partidos[fecha]", "dateFormat" => "yyyy-MM-dd", 'options' => ['required' => '', 'class' => 'form-control', "placeholder" => "aaaa-mm-dd"]])?>
                    <!-- <input value="<?= $model->fecha; ?>" placeholder="aaaa-mm-dd" type="date" id="partidos-fecha" class="form-control" name="Partidos[fecha]"> -->
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-hora">
                <label class="col-md-4 control-label">Hora del partido:</label>
                <div class="col-md-8">
                    <input value="<?= $model->hora; ?>" type="time" id="partidos-hora" class="form-control" name="Partidos[hora]" required>
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-id_cancha required">
                <label class="col-md-4 control-label">Cancha:</label>
                <div class="col-md-8">
                    <select class="form-control selectpicker" data-live-search="true" data-size="10" name="Partidos[id_cancha]" required id="partidos-id_cancha">
                        <option value="">Selecciona una cancha</option>
                        <?php foreach($canchas as $row){?>
                            <option value="<?= $row['id_cancha'];?>"><?= $row['nombre'];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-costo">
                <label class="col-md-4 control-label">Costo del partido:</label>
                <div class="col-md-8 input-group">
                    <span class="input-group-addon">$</span><input value="<?= $model->costo; ?>" type="number" id="partidos-costo" class="form-control" name="Partidos[costo]" required>
                </div>
            </div>

            <div class="form-group col-md-12 field-partidos-venta">
                <label class="col-md-4 control-label">Precio de venta:</label>
                <div class="col-md-8 input-group">
                    <span class="input-group-addon">$</span><input value="<?= $model->venta; ?>" type="number" id="partidos-venta" class="form-control" name="Partidos[venta]" required>
                </div>
            </div>

            <?php if(!$model->isNewRecord){ ?>
            <div class="form-group col-md-12 field-partidos-estado">
                <label class="col-md-4 control-label">Estado del partido:</label>
                <div class="col-md-8">
                    <select class="form-control" name="Partidos[estado]" required id="partidos-estado">
                        <option value="">Selecciona un estado</option>
                        <?php foreach($estados as $row){?>
                            <option value="<?= $row['id_estado'];?>"><?= $row['nombre'];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <?php } ?>


            <div class= "form-group col-md-12 text-center">
                    <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
