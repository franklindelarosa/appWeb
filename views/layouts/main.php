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
    <script type="text/javascript" charset="utf8" src="<?= Yii::$app->request->baseUrl; ?>/js/jquery.min.js"></script>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        
        <?php
            NavBar::begin([
                'brandLabel' => '<a class="navbar-brand" href="'.Yii::$app->homeUrl.'"><img alt="Brand" src="'.Yii::$app->request->baseUrl.'/images/icono.png">&nbspFútbol Cracks</a>',
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
                    ['label' => 'Canchas',
                        'items' => [
                            ['label' => 'Crear cancha', 'url' => ['/canchas/create']],
                            ['label' => 'Listar canchas', 'url' => ['/canchas/index']],
                        ],
                    ],
                    Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Partidos',
                        'items' => [
                            ['label' => 'Crear partido', 'url' => ['/partidos/create']],
                            ['label' => 'Listar partidos', 'url' => ['/partidos/index']],
                        ],
                    ],
                    Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Usuarios',
                        'items' => [
                            ['label' => 'Crear usuario', 'url' => ['/usuarios/create']],
                            ['label' => 'Listar usuarios', 'url' => ['/usuarios/index']],
                        ],
                    ],
                    Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Estados',
                        'items' => [
                            ['label' => 'Crear estado', 'url' => ['/estados/create']],
                            ['label' => 'Listar estados', 'url' => ['/estados/index']],
                        ],
                    ],
                    Yii::$app->user->isGuest ?
                    ['label' => ''] :
                    ['label' => 'Consulta', 'url' => ['/consulta/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => ''] :
                        [
                            'label' => 'Mi perfil',
                            'items' => [
                                ['label' => 'Mi perfil', 'url' => ['/usuarios/view?id='.Yii::$app->user->id]],
                                ['label' => 'Salir (' . Yii::$app->user->identity->username . ')',
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post']],
                            ]
                        ]
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
            <p class="pull-left">&copy; Fútbol Cracks <?= date('Y') ?></p>
            <p class="pull-right">Powered by Elecsis</p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
