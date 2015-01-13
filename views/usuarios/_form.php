<script>
    $(document).ready(function() {
        $('#sexo').val("<?= $model['sexo'];?>");
        $('#perfil').val("<?= $model['perfil'] ?>");
        $('#usuarios-estado').val("<?= $model['estado'] ?>");
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
                    <label for="nombres" class="col-md-2 control-label">Nombre(s):</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['nombres'];?>" name="Usuarios[nombres]" placeholder="Nombre(s)" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="apellidos" class="col-md-2 control-label">Apellido(s):</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['apellidos'];?>" name="Usuarios[apellidos]" placeholder="Apellido(s)" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="telefono" class="col-md-2 control-label">Telefono:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['telefono'];?>" name="Usuarios[telefono]" placeholder="Telefono" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="email" class="col-md-2 control-label">Email:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['correo'];?>" name="Usuarios[correo]" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="contrasena" class="col-md-2 control-label">Contraseña:</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="Usuarios[contrasena]" placeholder="Contraseña" <?= $model->isNewRecord ? 'required' : '' ?> >
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="sexo" class="col-md-2 control-label">Sexo:</label>
                    <div class="col-md-10">
                        <select id="sexo" name="Usuarios[sexo]" class="form-control" required>
                            <option value="">Selecciona el sexo</option>
                            <option value="m">Masculino</option>
                            <option value="f">Femenino</option>
                        </select>
                    </div>
                </div>

                <?php if(!$model->isNewRecord){ ?>
                <div class="form-group col-md-12 field-usuarios-estado">
                    <label class="col-md-2 control-label">Estado del usuario:</label>
                    <div class="col-md-10">
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
                    <label for="perfil" class="col-md-2 control-label">Perfil:</label>
                    <div class="col-md-10">
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
