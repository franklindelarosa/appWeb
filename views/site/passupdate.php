<script>
	$(document).ready(function() {
		$('#btn-reestablecer').on('click', function(event) {
			event.preventDefault();
			if($('#password').val() !== $('#confirm').val()){
				success('Las contraseñas introducidas no coinciden, verifícalas y vuelve a intentarlo','3');
			}else{
				$.post('passupdate', {password: $('#password').val(), auth: '<?=$accessToken;?>'}).done(function(result){
					if(result.status === 'ok'){
						success(result.mensaje,'1');
						setTimeout(function(){window.location="http://fcracks.com/"},3000);
					}else{
						success(result.mensaje,'3');
					}
				});
			}
		});
	});
</script>
<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Reestablecimiento de contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-passupdate">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
	<div class="row" style="padding:5% 0">
		<div class="col-md-6 col-md-offset-3 ">
			<div class="panel panel-primary">
				<div class="panel-body">
					<p class="text-center"><img src="<?= Yii::$app->request->baseUrl; ?>/images/logo.png" alt="Logo FutbolCracks"></p>
					<form class="form-horizontal" id="formulario-reestablecer" role="form" action="passupdate">
						<div class="form-group">
	                        <label class="text-left control-label col-md-3" for="password">Nueva Contraseña</label>
	                        <div class="col-md-8">
								<input id="password" type="password" name="password" placeholder="Nueva contraseña" class="form-control" required>
	                        </div>
						</div>
						<div class="form-group">
	                        <label class="text-left control-label col-md-3" for="confirm">Confirmar Contraseña</label>
	                        <div class="col-md-8">
	                        	<input id="confirm" type="password" name="confirm" placeholder="Confirmar Contraseña" class="form-control" required>
	                        </div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<button id="btn-reestablecer" type="button" class="btn btn-lg btn-block btn-success">Reestablecer</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>