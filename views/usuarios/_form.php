<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-9 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Usuarios</h3>
            </div>
            <div class="panel-body">

            <div class="usuarios-form">

                <?php $form = ActiveForm::begin(); ?>
<!-- 
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => 45]) ?>

                <?= $form->field($model, 'usuario')->textInput(['maxlength' => 45]) ?>

                <?= $form->field($model, 'contrasena')->textInput(['maxlength' => 70]) ?>

                <?= $form->field($model, 'sexo')->textInput(['maxlength' => 1]) ?>

                <?= $form->field($model, 'telefono')->textInput(['maxlength' => 20]) ?>

                <?= $form->field($model, 'correo')->textInput(['maxlength' => 45]) ?> -->

                <div class="form-group col-md-12">
                    <label for="nombre" class="col-md-2 control-label">Nombre:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['nombre'];?>" name="Usuarios[nombre]" placeholder="Nombre">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="nombre" class="col-md-2 control-label">Usuario:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['usuario'];?>" name="Usuarios[usuario]" placeholder="Usuario">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="nombre" class="col-md-2 control-label">Contraseña:</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="Usuarios[contrasena]" placeholder="Contraseña">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="nombre" class="col-md-2 control-label">Sexo:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['sexo'];?>" name="Usuarios[sexo]" placeholder="Sexo">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="nombre" class="col-md-2 control-label">Telefono:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['telefono'];?>" name="Usuarios[telefono]" placeholder="Telefono">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="nombre" class="col-md-2 control-label">Email:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= $model['correo'];?>" name="Usuarios[correo]" placeholder="Email">
                    </div>
                </div>

                <div class= "col-md-12">
                    <div class="form-group col-md-6 text-center">
                        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <a href="<?= Yii::$app->request->baseUrl; ?>/usuarios/index" class="btn btn-primary">Volver</a>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
