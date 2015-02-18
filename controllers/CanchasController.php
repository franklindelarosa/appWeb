<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Canchas;
use app\models\CanchasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\db\Query;

/**
 * CanchasController implements the CRUD actions for Canchas model.
 */
class CanchasController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['Administrador'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Canchas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CanchasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Canchas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Canchas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Canchas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_cancha]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Canchas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id_cancha]);
        } else {
            $query = new Query;
            $estados = $query->select('*')->from('estados')->where('entidad = "canchas"')->all();
            return $this->render('update', [
                'model' => $model,
                'estados' => $estados,
            ]);
        }
    }

    /**
     * Deletes an existing Canchas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $cancha = $this->findModel($id);
        if($cancha->imagen_logo !== 'default.jpg'){
            unlink('images/logos/'.$cancha->imagen_logo);
        }
        if($cancha->imagen_cancha !== 'default.jpg'){
            unlink('images/canchas/'.$cancha->imagen_cancha);
        }
        $cancha->delete();

        return $this->redirect(['index']);
    }

    public function actionUpload()
    {
        $model = new UploadForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $cancha = $this->findModel($model->cancha);
                $nombre_archivo = md5(time()).'.'. $model->file->extension;
                if($model->destino === 'logos'){
                    if($cancha->imagen_logo !== 'default.jpg'){
                        unlink('images/logos/'.$cancha->imagen_logo);
                    }
                    $cancha->imagen_logo = $nombre_archivo;
                }else{
                    if($cancha->imagen_cancha !== 'default.jpg'){
                        unlink('images/canchas/'.$cancha->imagen_cancha);
                    }
                    $cancha->imagen_cancha = $nombre_archivo;
                }
                // $mask = 'images/'.$model->destino.'/'.$model->cancha.'*.*';
                // array_map('unlink', glob($mask));
                // $model->file->saveAs('images/'.$model->destino.'/'.$model->cancha.'.'. $model->file->extension);
                $model->file->saveAs('images/'.$model->destino.'/'.$nombre_archivo);
                $cancha->save(false);
            }
        }
        return $this->redirect(['view', 'id' => $model->cancha, 'status' => '1']);
    }

    /**
     * Finds the Canchas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Canchas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Canchas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
