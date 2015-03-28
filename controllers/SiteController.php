<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\Estados;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['index', 'logout'],
                'rules' => [
                    [
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'activate', 'about', 'passupdate'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'layoutLogin';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionActivate($accessToken)
    {
        $model = Usuarios::find()->where(['accessToken' => $accessToken])->one();
        if($model !== null){
            if($model->estado === Estados::USUARIO_SIN_VERIFICAR){
                $model->estado = Estados::USUARIO_ACTIVO;
                $model->accessToken = md5(time().'csrf'.rand());
                if($model->save()){
                    $result['status'] = 'ok';
                    $result['mensaje'] = 'Tu cuenta ha sido verificada exitosamente, ya puedes acceder y disfrutar desde la aplicación móvil';
                }else{
                    $result['status'] = 'bad';
                    $result['mensaje'] = 'No se pudo completar la verificación, intenta reenviar la solicitud que te fue enviada al correo';
                }
            }elseif($model->estado === Estados::USUARIO_ACTIVO){
                $result['status'] = 'ok';
                $result['mensaje'] = 'Esta cuenta ya ha sido verificada anteriormente, puedes acceder sin ningún problema a tu cuenta desde la aplicación móvil';
            }else{
                $result['status'] = 'bad';
                $result['mensaje'] = 'No se pudo completar la verificación, puede que hayas sido bloqueado por algún comportamiento inadecuado, contactanos para poder ayudarte a disfrutar de FutbolCracks';
            }
            return $this->render('activate',['model' => $model, 'result' => $result]);
        }else{
            $result['status'] = 'bad';
            $result['mensaje'] = 'No se pudo verificar tu cuenta, verifica que no hayas modificado la dirección de confirmación enviada a tu correo';
            return $this->render('activate',['result' => $result]);
        }
    }


    public function actionPassupdate($accessToken = null)
    {
        if(Yii::$app->request->post()){
            \Yii::$app->response->format = 'json';
            $model = Usuarios::find()->where("authPass = '".$_POST['auth']."'")->one();
            if($model !== null){
                $model->contrasena = sha1($_POST['password']);
                if($model->save()){
                    $model->authPass = NULL;
                    $model->save();
                    return ['status' => 'ok', 'mensaje' => 'Tu contraseña se ha reestablecido exitosamente'];
                }else{
                    return ['status' => 'bad', 'mensaje' => 'No se pudo reestablecer tu contraseña, intenta nuevamente'];
                }
            }else{
                return ['status' => 'bad', 'mensaje' => 'El enlace generado tiene una falla, ponte en contacto con nosotros para poder ayudarte a recuperar tu contraseña'];
            }
        }elseif(isset($accessToken)){
            return $this->render('passupdate',['accessToken' => $accessToken]);
        }else{
            throw new \yii\web\HttpException(404, 'Página no encontrada');
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
