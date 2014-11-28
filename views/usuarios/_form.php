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

                <?= $form->field($model, 'nombre')->textInput(['maxlength' => 45]) ?>

                <?= $form->field($model, 'usuario')->textInput(['maxlength' => 45]) ?>

                <?= $form->field($model, 'contrasena')->textInput(['maxlength' => 70]) ?>

                <?= $form->field($model, 'sexo')->textInput(['maxlength' => 1]) ?>

                <?= $form->field($model, 'telefono')->textInput(['maxlength' => 20]) ?>

                <?= $form->field($model, 'correo')->textInput(['maxlength' => 45]) ?>

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
