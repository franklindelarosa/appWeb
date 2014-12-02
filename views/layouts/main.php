<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/css/bootstrapValidator.min.css"/>
    <script type="text/javascript" charset="utf8" src="<?= Yii::$app->request->baseUrl; ?>/js/jquery.min.js"></script>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Futbol Cracks',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                     Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Canchas', 'url' => ['/canchas/index']],
                    Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Partidos', 'url' => ['/partidos/create']],
                    Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Consulta', 'url' => ['/consulta/index']],
                    Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Mi perfil', 'url' => ['/usuarios/update?id='.Yii::$app->user->id]],
                    Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Usuarios', 'url' => ['/usuarios/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Entrar', 'url' => ['/site/login']] :
                        ['label' => 'Salir (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
