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

$this->title = 'Biegi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <br/>
    <?= Html::button('Dodaj nowy bieg',
        ['class' => 'btn btn-primary', 'name' => 'login-button','onclick'=>'window.location="index.php?r=roads%2Faddroad";']) ?>
    <?php
        $columns=[
            [
                'class' => 'yii\grid\SerialColumn',
               // 'contentOptions' => ['class' => 'row-invisible'],
               // 'headerOptions' => ['class' => 'row-invisible'],
            ],
            [
                'label'=>"Nazwa trasy",
                'attribute'=>'title',
            ],
            [
                'label'=>"Dystans",
                'attribute'=>'distance',
            ],
            [
                'label'=>"Miejsce",
                'attribute'=>'place',
            ],
            [
                'label'=>"Data startu",
                'attribute'=>'date_term',
                'filter' => DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'date_term',
                    'convertFormat' => true,
                    //'presetDropdown'=>true,
                    'language'=>"pl",
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d',
                          //  'separator' => ' - ',
                            'opens' => 'left'
                        ]
                    ]
                ])
            ],
            [
                'label'=>"Czas startu",
                'attribute'=>'time_term',
            ],
            [
                'label'=>"Start rejestracji",
                'attribute'=>'start_register',
                'filter' => DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'start_register',
                    'convertFormat' => true,
                    //'presetDropdown'=>true,
                    'language'=>"pl",
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d',
                            //'separator' => ' - ',
                            'opens' => 'left'
                        ]
                    ]
                ])
            ],
            [
                'label'=>"Koniec rejestracji",
                'attribute'=>'end_register',
                'filter' => DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'end_register',
                    'convertFormat' => true,
                    //'presetDropdown'=>true,
                    'language'=>"pl",
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d',
                            'separator' => ' - ',
                            'opens' => 'left'
                        ]
                    ]
                ])
            ],
            [
                'label'=>"Typ trasy",
                'attribute'=>'road_type',
            ],
            [
                'label'=>"Limit czasowy na trasie",
                'attribute'=>'limit_time_on_road',
            ],
            /*[
                'label'=>"Cena wstępu",
                'attribute'=>'buy',
            ],
            [
                'label'=>"Link",
                'attribute'=>'link',
            ],
            [
                'label'=>"Limit miejsc",
                'attribute'=>'available',
            ],
            [
                'label'=>"Uwaga",
                'attribute'=>'attention',
            ],*/


            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ];



    ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $model,
        'pjax' => true,
       /* 'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,*/
        'columns' => $columns,
        //'hover' => true,
    ]) ?>


</div>
