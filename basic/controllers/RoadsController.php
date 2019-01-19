<?php

namespace app\controllers;

use app\models\InterviewQuery;
use app\models\Interview;
use app\models\Marathons;
use app\models\Operator;
use app\models\Users;
use app\models\UsersOfMarathons;
use app\models\UsersOfMarathonsSearch;
use app\models\UsersQuery;
use app\models\UsersSearch;
use app\models\MarathonsSearch;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;

class RoadsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */


    /**
     * Login action.
     *
     * @return string
     */


    public function actionAddroad(){

        $model = new Marathons();
        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
            return $this->redirect('index.php?r=roads%2Findex');// goHome();
        }
        return $this->render('addroad', [
            'model' => $model,
        ]);
    }

    public function actionIndex(){
        if(Yii::$app->user->isGuest){
            return $this->goBack();
        }
        $searchModel = new MarathonsSearch();
        $dataProvid = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('roads', [
            'model' => $searchModel,
            'dataProvider'=>$dataProvid,
        ]);
    }

    public function actionDelete($id) {
        Marathons::deleteAll(['id'=>$id]);
        return $this->redirect('index.php?r=roads%2Findex');
    }

    public function actionUpdate($id) {

        $model=Marathons::findOne(['id'=>$id]);

        $listDataProvider = new ActiveDataProvider([
            'query' => $model,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Saved record successfully');
            Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            Yii::$app->session->setFlash('kv-detail-info',
                '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.'
            );
            return $this->redirect('index.php?r=roads%2Findex');
        } else {
            return $this->render('../actions/update/road.php',
                ['model'=>$model,'list'=>$listDataProvider]);
        }
    }



}
