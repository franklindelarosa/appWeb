<script>
	$(document).ready(function() {
		$('#login-form').bootstrapValidator({
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			// fields: {
			// 	LoginForm[username]: {
			// 		validators: {
			// 			notEmpty: {
			// 				message: 'El nombre de usuario es requerido'
			// 			},//3006877024
			// 		}
			// 	},
			// 	LoginForm[password]: {
			// 		validators: {
			// 			notEmpty: {
			// 				message: 'La contraseña es requerida'
			// 			},
			// 		}
			// 	},
			// }
		});
	});
</script>
<?php
use yii\bootstrap\ActiveForm;
$this->params['breadcrumbs'][] = 'Ingresar';
?>
<div class="row">
	<div class="col-md-6 col-md-offset-3 ">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Ingresar</h3>
			</div>
			<div class="panel-body">
				<p class="text-center"><img src="../../web/images/logo_login.jpg" alt="Futbol Cracks"></p>
				<?php $form = ActiveForm::begin([
					'id' => 'login-form',
					'options' => ['class' => 'form-horizontal', 'name' => 'formulario'],
					'fieldConfig' => [
						'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
						'labelOptions' => ['class' => 'col-lg-1 control-label'],
					],
				]); ?>
					<div class="form-group field-loginform-username">
                        <label class="text-left control-label col-md-3" for="LoginForm[username]">Usuario</label>
                        <div class="col-md-8">
							<input type="text" name="LoginForm[username]" data-bv-notempty="true" data-bv-notempty-message="El nombre de usuario es requerido" placeholder="Usuario" class="form-control" required>
                        </div>
					</div>
					<div class="form-group field-loginform-password required">
                        <label class="text-left control-label col-md-3" for="LoginForm[password]">Contraseña</label>
                        <div class="col-md-8">
                        	<input type="password" name="LoginForm[password]" data-bv-notempty="true" data-bv-notempty-message="La contraseña es requerida" placeholder="Contraseña" class="form-control" required>
                        	<div class="col-lg-12 has-error"><p class="text-center help-block help-block-error"><?= $model->getFirstError('password'); ?></p></div>
                        </div>
					</div>
					<div class="form-group">
                        <div class="checkbox col-md-10 col-md-offset-1">
							<label>
								<input type="checkbox" name="LoginForm[rememberMe]" value="remember-me"> Recordarme?
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button type="submit" class="btn btn-lg btn-block btn-success">Ingresar</button>
						</div>
					</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>