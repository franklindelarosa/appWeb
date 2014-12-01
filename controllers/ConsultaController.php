<?php

namespace app\controllers;

use Yii;
use app\models\Consulta;
use app\models\ConsultaSearch;
use yii\web\Controller;

class ConsultaController extends Controller
{
    public function actionIndex()
    {
    	$searchModel = new ConsultaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
