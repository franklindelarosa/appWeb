<script>
    $(document).ready(function() {
        $('#sexo').val("<?= $model['sexo'];?>");
        $('#perfil').val("<?= $model['perfil'] ?>");
        $('#usuarios-estado').val("<?= $model['estado'] ?>");
        "<?= $model['fecha_nacimiento']; ?>" !== '0000-00-00' ? $('#fecha_nacimiento').val("<?= $model['fecha_nacimiento'] ?>") : "";
        $('#pierna_habil').val("<?= $model['pierna_habil']; ?>");
        <?php if($model->isNewRecord){ ?>
            $('#posicion').val("1");
        <?php }else{ ?>
            $('#posicion').val("<?= $model['id_posicion']; ?>");
        <?php } ?>
    });
</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<div class="col-md-9 col-md-offset-2">
        <div class="panel panel-primary">
            <br>
            <div class="panel-body">

            <div class="usuarios-form">

                <?php $form = ActiveForm::begin(['id' => 'usuarios-form']); ?>

                <div class="form-group col-md-12">
                    <label for="nombres" class="col-md-3 control-label">Nombre(s):</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $model['nombres'];?>" name="Usuarios[nombres]" placeholder="Nombre(s)" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="apellidos" class="col-md-3 control-label">Apellido(s):</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $model['apellidos'];?>" name="Usuarios[apellidos]" placeholder="Apellido(s)" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="fecha_nacimiento" class="col-md-3 control-label">Fecha de nacimiento:</label>
                    <div class="col-md-9">
                        <?= yii\jui\DatePicker::widget(["id" => "fecha_nacimiento", "name" => "Usuarios[fecha_nacimiento]", "dateFormat" => "yyyy-MM-dd", 'options' => ['value' => $model['fecha_nacimiento'], 'class' => 'form-control', "placeholder" => "aaaa-mm-dd"], 'clientOptions'=>['yearRange' => $rango_fecha, 'changeMonth'=>'true', 'changeYear'=>'true'], 'language'=>'es'])?>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="telefono" class="col-md-3 control-label">Telefono:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $model['telefono'];?>" name="Usuarios[telefono]" placeholder="Telefono" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="email" class="col-md-3 control-label">Email:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $model['correo'];?>" name="Usuarios[correo]" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="contrasena" class="col-md-3 control-label">Contraseña:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="Usuarios[contrasena]" placeholder="Contraseña" <?= $model->isNewRecord ? 'required' : '' ?> >
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="sexo" class="col-md-3 control-label">Sexo:</label>
                    <div class="col-md-9">
                        <select id="sexo" name="Usuarios[sexo]" class="form-control" required>
                            <option value="">Selecciona el sexo</option>
                            <option value="m">Masculino</option>
                            <option value="f">Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="pierna_habil" class="col-md-3 control-label">Pierna hábil:</label>
                    <div class="col-md-9">
                        <select id="pierna_habil" name="Usuarios[pierna_habil]" class="form-control">
                            <option value="">Sin definir</option>
                            <option value="Derecha">Derecha</option>
                            <option value="Izquierda">Izquierda</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="posicion" class="col-md-3 control-label">Posición:</label>
                    <div class="col-md-9">
                        <select id="posicion" name="Usuarios[id_posicion]" class="form-control">
                            <?php foreach($posiciones as $row){?>
                                <option value="<?= $row['id_posicion'];?>"><?= $row['posicion'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>

                <?php if(!$model->isNewRecord){ ?>
                <div class="form-group col-md-12 field-usuarios-estado">
                    <label class="col-md-3 control-label">Estado del usuario:</label>
                    <div class="col-md-9">
                        <select class="form-control" name="Usuarios[estado]" required id="usuarios-estado">
                            <option value="">Selecciona un estado</option>
                            <?php foreach($estados as $row){?>
                                <option value="<?= $row['id_estado'];?>"><?= $row['nombre'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <?php } ?>

                <?php if(Yii::$app->user->can('Administrador')){?>
                <div class="form-group col-md-12">
                    <label for="perfil" class="col-md-3 control-label">Perfil:</label>
                    <div class="col-md-9">
                        <select id="perfil" name="Usuarios[perfil]" class="form-control">
                            <option value="">Selecciona un perfil</option>
                            <?php foreach($roles as $row){?>
                                <option value="<?= $row['name'];?>"><?= $row['name'];?></option>
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
