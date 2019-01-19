<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use kartik\grid\GridView;
use kartik\grid\Module;
use yii\widgets\InputWidget;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use kartik\field\FieldRange;
use kartik\daterange\DateRangePicker;


$this->title = 'Biegacze';
$this->params['breadcrumbs'][] = $this->title;
$choice_sex=[1=>"Kobieta",2=>"Mężczyzna"];
$choice_attentions=[1=>"Tak",2=>"Nie"];
$size_shirts=[ 'XL','M','L','XL','S','XXL'];
$states=
    [
    1=>"małopolskie",
    2=>"śląskie",
    3=>"dolnośląskie",
    4=>"lubelskie",
    5=>"łódzkie",
    6=>"pomorskie",
    7=>"świętokrzyskie",
    8=>"kujawsko-pomorskie",
    9=>"podkarpackie",
    10=>"podlaskie",
    11=>"lubuskie",
    12=>"opolskie",
    13=>"zachodniopomorskie",
    14=>"wielkopolskie",
    15=>"warmińsko-mazurskie",
    16=>"mazowieckie"];
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        $columns=[
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'email',
                'value' =>'email',
                'label'=>"Email",
               // 'filter' => InputWidget::widget(),



            ],
            [
                'label'=>"Imię",
                'attribute'=>'uname',
            ],
            [
                'label'=>"Nazwisko",
                'attribute'=>'surname',
            ],
            [
                'label'=>"Płeć",
                'attribute'=>'sex',
                'filter'=>$choice_sex,
                'value'=>function($data) use($choice_sex){
                    return $choice_sex[$data['sex']];
                },
            ],
            [
                'label'=>"Telefon",
                'attribute'=>'phone',
                'format' => 'raw',
            ],
            [
                'label'=>"Województwo",
                'attribute'=>'state',
                //'filter'=>$states,
            ],
            [
                'label'=>"Miasto",
                'attribute'=>'city'
            ],
            /*[
                'label'=>"Ulica",
                'attribute'=>'street'
            ],*/
           /* [
                'label'=>"Rozmiar koszulki",
                'attribute'=>'shirt_size',
                'width'=>"35px"
                //'filter'=>$size_shirts,

            ],*/
            [
                'label'=>"Dołączył",
                'attribute' => 'join_date',
                'filter' => DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'join_date',
                    'convertFormat' => true,
                    //'presetDropdown'=>true,

                    'language'=>"pl",
                    'pluginOptions' => [
                    'locale' => [
                        'format' => 'Y-m-d',
                        'separator' => ' - ',
                        'opens' => 'center',
                        ]
                    ]
                ])
            ],
            [
                'label'=>"Uwagi dodatkowe",
                'value'=>function($data){
                    $uwagi= \app\models\Interview::findAll(["id_runner_history"=>$data->id]);
                    $ilosc_uwag=0;
                    foreach($uwagi as $uwaga){
                        $ilosc_uwag++;
                    }
                    if($ilosc_uwag>0) return "<b style='color:green'>TAK</b>";
                    else return "<b style='color:red'>NIE</b>";
                },
                'format'=>'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ];
    ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $model,
        'columns' => $columns,
    ]) ?>


</div>
