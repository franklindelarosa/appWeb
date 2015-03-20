<script>
    $(document).ready(function() {
        $('#id-usuario').val('<?= $model->id_usuario; ?>');
        $('#editar-foto').on('click', function(event) {
            event.preventDefault();
            $('#foto-modal').modal({backdrop:'static'});
        });
    });
</script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->nombres." ".$model->apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="imagen-container">
        <div class="profile-image">
            <img src="<?= Yii::$app->request->baseUrl.'/../../fcapi/web/fotos/'.$model->foto ?>" alt="Foto de perfil">
            <?= Html::a('', ['eliminar-foto','id'=>$model->id_usuario], ['title'=>'Eliminar foto', 'class' => 'glyphicon glyphicon-remove','data' => [
                    'confirm' => '¿Está seguro que desea eliminar esta foto?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('', null, ['title'=>'Cambiar foto', 'id' => 'editar-foto', 'class' => 'glyphicon glyphicon-edit']) ?>
        </div>
    </div>
    <p class="btn-right">
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>

        <?php if(Yii::$app->user->id != $model->id_usuario){ ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id_usuario], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Está seguro que desea eliminar este usuario?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
        <a href="<?= Yii::$app->request->baseUrl; ?>/usuarios/index" class="btn btn-default">Volver</a>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_usuario',
            'nombres',
            'apellidos',
            // 'usuario',
            // 'contrasena',
            [
                'attribute' => 'fecha_nacimiento',
                'value' => $model->fecha_nacimiento === NULL ? 'Sin definir' : $model->fecha_nacimiento,
            ],
            ['attribute' => 'sexo', 'value' => $model->sexo === 'f' ? 'Femenino' : 'Masculino'],
            'telefono',
            'correo',
            [
                'attribute' => 'id_posicion',
                'value' => $model->idPosicion->posicion,
            ],
            [
                'attribute' => 'pierna_habil',
                'value' => $model->pierna_habil !== NULL ? $model->pierna_habil : 'Sin definir',
            ],
            [
                'attribute' => 'estado',
                'value' => $model->idEstado->nombre,
            ],
        ],
    ]) ?>

    <div id="foto-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Selecciona la nueva imagen</h4>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'name' => 'formulario'], 'action' => 'actualizar-foto']); ?>
                        <div class="col-md-9">
                            <input id="input-1" required name="FotoPerfil[file]" type="file" class="file filestyle" data-buttonName="btn-primary" data-buttonText="Examinar">
                            <input id="id-usuario" hidden required name="FotoPerfil[usuario]" type="text"><br>
                        </div>
                        <div class="col-md-2">
                            <button id="cargar" type="submit" class="btn btn-success" name="submit">Cargar Imagen</button>
                        </div><br>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>
