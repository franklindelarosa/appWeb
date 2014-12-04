<?php
use yii\bootstrap\ActiveForm;
$this->params['breadcrumbs'][] = 'Ingresar';
?>
<div class="row">
	<div class="col-md-6 col-md-offset-3 ">
		<div class="panel panel-primary">
			<div class="panel-body">
				<p class="text-center"><img src="<?= Yii::$app->request->baseUrl; ?>/images/logo.png" alt="Futbol Cracks"></p>
				<?php $form = ActiveForm::begin([
					'id' => 'login-form',
					'options' => ['class' => 'form-horizontal'],
					'fieldConfig' => [
						'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
						'labelOptions' => ['class' => 'col-lg-1 control-label'],
					],
				]); ?>
					<div class="form-group field-loginform-username">
                        <label class="text-left control-label col-md-3" for="LoginForm[username]">Usuario</label>
                        <div class="col-md-8">
							<input type="text" name="LoginForm[username]" placeholder="Usuario" class="form-control" required>
                        </div>
					</div>
					<div class="form-group field-loginform-password">
                        <label class="text-left control-label col-md-3" for="LoginForm[password]">Contraseña</label>
                        <div class="col-md-8">
                        	<input type="password" name="LoginForm[password]" placeholder="Contraseña" class="form-control" required>
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