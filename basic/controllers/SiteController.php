<?php

namespace app\controllers;

use app\models\InterviewQuery;
use app\models\Interview;
use app\models\InterviewSearch;
use app\models\ListPayments;
use app\models\Marathons;
use app\models\Operator;
use app\models\Payment;
use app\models\Reminder;
use app\models\Users;
use app\models\UsersOfMarathons;
use app\models\UsersOfMarathonsSearch;
use app\models\UsersQuery;
use app\models\UsersSearch;
use app\models\MarathonsSearch;
use Yii;
use yii\base\Exception;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii2mod\editable\Editable;
use yii2mod\editable\EditableAction;
use kartik\mpdf\Pdf;// \mpdf\Pdf;

class SiteController extends Controller
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
            'change-status-marathon-for-user' => [
                'id'=>'cms2',
                'class' => EditableAction::className(),
                'modelClass' => UsersOfMarathons::className(),
                'forceCreate' => false
            ],
            'change-message-content-interview' => [
                'id'=>'cms',
                'class' => EditableAction::className(),
                'modelClass' => Interview::className(),
                'forceCreate' => false
            ],
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
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('main');

        } else {
            return $this->render('index');
        }

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionOperator(){

        $model = new Operator();
        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
            return $this->goBack();
        }
        return $this->render('operator', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRunners()
    {
        if(Yii::$app->user->isGuest){
            return $this->goBack();
        }
        $searchModel = new UsersSearch();
        $dataProvid = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('runners', [
            'model' => $searchModel,
            'dataProvider'=>$dataProvid,
        ]);
    }

    public function actionAddroad(){

        $model = new Marathons();
        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
            return $this->redirect('index.php?r=site%2Froads');// goHome();
        }
        return $this->render('addroad', [
            'model' => $model,
        ]);
    }

    public function actionRoads(){
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
        Users::deleteAll(['id'=>$id]);
        return $this->redirect('index.php?r=site%2Frunners');
    }

    public function actionAuth(){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        require "classes/PayLaneRestClient.php";
        $kwota=Yii::$app->request->get('kwota');
        $card_params = array(
            "sale"      =>   array(
                "amount"            =>   $kwota,
                "currency"          =>   "PLN",
                "description"       =>   "ArunZ - abonament",
            ),
            "customer"  =>   array(
                "name"      =>   "John Doe",
                "email"     =>   "john@doe.com",
                "ip"        =>   "127.0.0.1",
                "address"   =>   array(
                    "street_house"  =>   "1600 Pennsylvania Avenue Northwest",
                    "city"          =>   "Washington",
                    "state"         =>   "DC",
                    "zip"           =>   "20500",
                    "country_code"  =>   "US"
                )
            ),
            "card"   =>   array   (
                "card_number"       =>   "4200000000000000",
                "expiration_month"  =>   "05",
                "expiration_year"   =>   "2017",
                "name_on_card"      =>   "John Doe",
                "card_code"         =>   "123"
            )
        );



        $client= new Payment("arunz","di7ce9sl");
        try {
            //$id_authorization = $client->checkCard($card_params);
            $id_authorization = $client->cardAuthorization($card_params);
            $status =$id_authorization;
            if ($client->isSuccess()) {
                return
                    "Autoryzacja karty zakończyła się sukcesem ! \n ID autoryzacji: ".$status['id_authorization']." \n";
            } else {
                die("Autoryzacja zakończyła się fiaskiem !\n Numer błędu: {$status['error']['error_number']}, \n".
                    "Opis błędu: {$status['error']['error_description']}");
            }
        } catch (Exception $e) {}
    }


    public function actionPay(){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        require "classes/PayLaneRestClient.php";

        $card_params2 = array(
            "card_number"       =>   "4200000000000000",
        );

        $card_params3 = array(

            "card_number"       =>   "4200000000000000",
            "expiration_month"  =>   "03",
            "expiration_year"   =>   "2017",
            "name_on_card"      =>   "John Doe",
            "ip"        =>   "127.0.0.1",
        );
        $idu=Yii::$app->request->get('idu');
        $idm=Yii::$app->request->get('idm');

        $nr_card=Yii::$app->request->get('nr_card');
        $date_card=Yii::$app->request->get('date_card');
        $uname_card=Yii::$app->request->get('uname_card');
        $surname_card=Yii::$app->request->get('surname_card');
        $cvv_cvc=Yii::$app->request->get('cvv_cvc');
        $kwota=Yii::$app->request->get('kwota');
        $users_email=Yii::$app->request->get('users_email');

        $uname=Yii::$app->request->get('uname');
        $surname=Yii::$app->request->get('surname');

        $elements_date=explode("-",$date_card);

        $card_params = array(
            "sale"      =>   array(
                "amount"            =>   $kwota,
                "currency"          =>   "PLN",
                "description"       =>   "ArunZ - abonament",
            ),
            "customer"  =>   array(
                "name"      =>   $uname." ".$surname,
                "email"     =>   $users_email,
                "ip"        =>   "127.0.0.1",
                "address"   =>   array(
                    "street_house"  =>   "1600 Pennsylvania Avenue Northwest",
                    "city"          =>   "Washington",
                    "state"         =>   "DC",
                    "zip"           =>   "20500",
                    "country_code"  =>   "US"
                )
            ),
            "card"   =>   array   (
                "card_number"       =>   $nr_card,//"4200000000000000",
                "expiration_month"  =>   $elements_date[1],//date("m",$date_card),
                "expiration_year"   =>   $elements_date[0],//date("y",$date_card),
                "name_on_card"      =>   $uname_card." ".$surname_card,//"John Doe",
                "card_code"         =>   $cvv_cvc,//"123"
            )
        );


        $client= new Payment("arunz","di7ce9sl");
        try {
            $id_authorization = $client->cardAuthorization($card_params);
            $resale_params = array(
                'id_authorization' => $id_authorization['id_authorization'],
                "amount"            =>   $kwota,
                "currency"          =>   "PLN",
                "description"       =>   "ArunZ - abonament",
            );
            $status =$client->resaleByAuthorization($resale_params);

            $new_record= new ListPayments();
            $new_record->load(
                ['idu'=>1,'payment_id'=>$id_authorization['id_authorization'],'payment_status'=>"udany",'payment_cash'=>$kwota." zł",'datetime_payment'=>date("y-m-d h:i:s")]
            );
            $new_record->idu=$idu;
            $new_record->idm=$idm;
            $new_record->payment_id =$id_authorization['id_authorization'];
            $new_record->payment_status="udany";
            $new_record->payment_cash=$kwota." zł";
            $new_record->datetime_payment=date("y-m-d h:i:s");
            $new_record->save();
            //$status = $client->cardAuthorization($card_params2);
            if ($client->isSuccess()) {
                return
                    "Płatność karty zakończyła się sukcesem ! \n ID płatności: ".$status['id_sale']." \n";
            } else {
                die("Płatność zakończyła się fiaskiem !\n Numer błędu: {$status['error']['error_number']}, \n".
                    "Opis błędu: {$status['error']['error_description']}");
            }
        } catch (Exception $e) {}


    }

    public function actionUpdate($id) {
        $model=Users::findOne(['id'=>$id]);

        $searchModel1 = new InterviewSearch();
        $dataProvid1 = $searchModel1->search(Yii::$app->request->queryParams);

        $history=Interview::find()
            ->select(['id','message_title','message_content','datetime_history'])
            ->where(['id_runner_history'=>$id]);
        $historyDataProvider = new ActiveDataProvider([
            'query' => $history,
        ]);

        $result_marathons=
            UsersOfMarathons::find()
                ->select(['users_of_marathons.id','idm','title','status','place','passing'])
                ->leftJoin('marathons','users_of_marathons.idm=marathons.id')
                ->where(['idu'=>$id]);
        $resultDataProvider = new ActiveDataProvider([
            'query' => $result_marathons,
        ]);

        $payments= ListPayments::find()
        ->select(['id','idu','payment_id','payment_status','payment_cash','datetime_payment'])
        ->where(['idu'=>$id]);

        $listpaymentsDataProvider = new ActiveDataProvider([
            'query' => $payments,
        ]);


        if (!empty($model) && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Saved record successfully');
            Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            Yii::$app->session->setFlash('kv-detail-info',
                '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.'
            );
            if (Yii::$app->getRequest()->isAjax){
                return Json::encode(['status' => true]);
            } else {
                return $this->redirect(['update', 'id'=>$model->id]);
            }

        } else {

            return $this->render('../actions/update/runner.php',
                ['model'=>$model,'resulter'=>$resultDataProvider,'history'=>$historyDataProvider,'model1'=>$searchModel1,'data1'=>$dataProvid1,'list'=>$listpaymentsDataProvider]);
        }
    }


    public function actionView($id) {
        $model=Users::findOne(['id'=>$id]);

        $history=Interview::find()
            ->select(['id','message_title','message_content','datetime_history'])
            ->where(['id_runner_history'=>$id]);

        $historyDataProvider = new ActiveDataProvider([
            'query' => $history,
        ]);

        $list_marathons=
            UsersOfMarathons::find()
                ->select(['idm','title','status','place'])
                ->leftJoin('marathons','users_of_marathons.idm=marathons.id')
                ->where(['idu'=>$id]);
        $listDataProvider = new ActiveDataProvider([
            'query' => $list_marathons,
        ]);

        $list_reminders=
            Reminder::find()
                ->select(['id','idu','note','datetime_reminder'])
                ->where(['idu'=>$id]);
        $reminderDataProvider = new ActiveDataProvider([
            'query' => $list_reminders,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Saved record successfully');
            Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            Yii::$app->session->setFlash('kv-detail-info',
                '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.'
            );
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('../actions/view/runner.php',
                ['model'=>$model,'result'=>$listDataProvider,'history'=>$historyDataProvider,'reminder'=>$reminderDataProvider]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionEditableDemo() {
        $model = new Interview();

        if (isset($_POST['hasEditable'])) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // read your posted model attributes
            if ($model->load($_POST)) {
                // read or convert your posted information
                $value = $model->message_content;

                // return JSON encoded output in the below format
                return ['output'=>$value, 'message'=>''];

                // alternatively you can return a validation error
                // return ['output'=>'', 'message'=>'Validation error'];
            }
            // else if nothing to do always return an empty JSON encoded output
            else {
                return ['output'=>'', 'message'=>''];
            }
        }

        // Else return to rendering a normal view
        return $this->render('view', ['model'=>$model]);
    }

    public function actionAddmarathontouser(){
        $id_trasy=Yii::$app->request->get('id_trasy');
        $id_user=Yii::$app->request->get('id_user');
        try {
            $model=new UsersOfMarathons();
            $id_traski=$model->findAll(['idm'=>$id_trasy,'idu'=>$id_user]);
            if(empty($id_traski)){
                $model->idm=$id_trasy;
                $model->idu=$id_user;
                $model->status=1;
                $model->load([
                    'idm'=>$id_trasy,
                    'idu'=>$id_user,
                    'status'=>1,
                ]);
                $model->save();
                $model->refresh();
                return "ok";
            } else {
                return 'nie ok';
            }
        } catch(Exception $e){
            return $e->getMessage();
        }
    }


    public function actionAddreminder(){
        $id_operator=Yii::$app->request->get("id_operator");
        $idu=Yii::$app->request->get('idu');
        $note=Yii::$app->request->get('note');
        $datetime=Yii::$app->request->get('datetime');
        try {
            $model=new Reminder();

                $model->id_operator=$id_operator;
                $model->idu=$idu;
                $model->note=$note;
                $model->datetime_reminder=$datetime;
                $model->load([
                    'note'=>$note,
                    'datetime'=>$datetime,
                ]);
                $model->save();
                $model->refresh();
                return "ok";
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function actionDropmarathonforuser(){
        $idks=Yii::$app->request->get('idk');
        $model=new UsersOfMarathons();
        foreach($idks as $idk){
            $model::deleteAll(["id"=>$idks]);
        }
        return "ok";
    }

    public function actionDropinterview(){
        $idks=Yii::$app->request->get('idk');
        $model=new Interview();
        foreach($idks as $idk){
            $model::deleteAll(["id"=>$idks]);
        }
        return "ok";
    }

    public function actionAddinterview(){
        $id=Yii::$app->request->get('id');

        $title=Yii::$app->request->get('message_title');
        $content=Yii::$app->request->get('message_content');

        $dates= new \DateTime();
        $datetime =$dates->format("Y-m-d h:i:s");
        $operator_id=Yii::$app->request->get('id_operator_history');
        $user_id=Yii::$app->request->get('id_runner_history');

        $model=new Interview();
        $model->id_operator_history=$operator_id;
        $model->id_runner_history=$user_id;
        $model->datetime_history=$datetime;
        $model->message_title=$title;
        $model->message_content=$content;

        $model->load([
            'id_operator_history'=>$operator_id,
            'id_runner_history'=>$user_id,
            'datetime_history'=>$datetime,
            'message_title'=>$title,
            'message_content'=>$content,
        ]);
        $model->save();
        $model->refresh();

        return "ok";
    }

    public function actionChangedatereminder(){
        $id=Yii::$app->request->post('id');
        $date=Yii::$app->request->post('datetimer');
        Reminder::updateAll(['datetime_reminder'=>$date],['id'=>$id]);

        return "ok";
    }

    public function actionChangenotereminder(){
        $id=Yii::$app->request->post('id');
        $title=Yii::$app->request->post('note');
        Reminder::updateAll(['note'=>$title],['id'=>$id]);

        return "ok";
    }

    public function actionDeletereminder(){
        $id=Yii::$app->request->post('id');
        Reminder::deleteAll(['id'=>$id]);

        return "ok";
    }

    public function actionJsoncalendar(){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $times = Reminder::find()->select(['id','idu','id_operator','note','datetime_reminder'])->all();

        $events = array();

        foreach ($times as $time){
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $time->id;
            $Event->title = $time->note;
            $Event->start = $time->datetime_reminder;
            $Event->startEditable=true;
            if($time->idu==0){
                $Event->backgroundColor="red";
            }
            $events[] = $Event;
        }

        return $events;
    }

    public function actionCreatepdf(){
        $id=Yii::$app->request->get('id');
        $payment=ListPayments::findOne(['id'=>$id]);

        $content = $this->renderPartial('pdf/_reportView',['payment'=>$payment]);

        $pdf = Yii::$app->pdf;
        $pdf->content = $content;

        //print_r($content);
        //print_r($payment);
        return $pdf->render();
    }
}
