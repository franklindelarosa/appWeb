<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Verificación de cuenta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-activate">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($result['status'] === 'ok'){?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><?= Html::encode('Correcto') ?></h3>
			</div>
			<div class="panel-body">
				<h4 >Estimad<?= ($model->sexo === 'm') ? 'o '.$model->nombres.' '.$model->apellidos : 'a '.$model->nombres.' '.$model->apellidos ?></h4><br>
				<p><?= $result['mensaje'] ?></p>
			</div>
		</div>
	<?php }else{ ?>
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title"><?= Html::encode('Error') ?></h3>
			</div>
			<div class="panel-body">
				<h4><?= Html::encode('Estimado usuario') ?></h4><br>
				<p><?= $result['mensaje'] ?></p>
			</div>
		</div>
	<?php } ?>
</div>