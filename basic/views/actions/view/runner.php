<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22.02.2017
 * Time: 22:35
 */
use kartik\detail\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;
use kartik\tabs\TabsX;

$this->title='Biegacz - '.$model->uname." ".$model->surname; // ;
$this->params['breadcrumbs'][]=['label'=>'Biegacze', 'url'=>['site/runners']];
$this->params['breadcrumbs'][]=$this->title;

$marathon_status=[1=>"Przyjęliśmy Twoje zgłoszenie na bieg",2=>"Zostałeś dodany do losowania!",3=>"Zostałaś zapisana na bieg! Szykuj się do startu"];
$medium=[0=>"",1=>"WhatsApp",2=>"Facebook",3=>"Messenger"];

$attributes=[
    [
        'label'=>'Email',
        'attribute'=>'email',
        'format'=>'raw',
        'displayOnly'=>true
    ],
    [
        'label'=>'Imię',
        'attribute'=>'uname',
        'format'=>'raw',
        'displayOnly'=>true
    ],
    /*[
        'label'=>'Imię',
        'attribute'=>'uname',
        'format'=>'raw',
        'displayOnly'=>true
    ],*/
    [
        'label'=>'Nazwisko',
        'attribute'=>'surname',
        'format'=>'raw',
        'displayOnly'=>true
    ],

    [
        'label'=>'Telefon',
        'attribute'=>'phone',
        'format'=>'raw',

        'displayOnly'=>true
    ],
    [
        'label'=>'Kod pocztowy',
        'attribute'=>'zip_code',
        'format'=>'raw',

        'displayOnly'=>true
    ],
    [
        'label'=>'Województwo',
        'attribute'=>'state',
        'format'=>'raw',

        'displayOnly'=>true
    ],
    [
        'label'=>'Miasto',
        'attribute'=>'city',
        'format'=>'raw',

        'displayOnly'=>true
    ],
    [
        'label'=>'Ulica',
        'attribute'=>'street',
        'format'=>'raw',

        'displayOnly'=>true
    ],
    [
        'label'=>'-Biegam, od:',
        'attribute'=>'walking_for',
        'format'=>'raw',

        'displayOnly'=>true
    ],
    [
        'label'=>'-Biegam, ponieważ:',
        'attribute'=>'walking_because',
        'format'=>'raw',

        'displayOnly'=>true
    ],
    [
        'label'=>'-Biegam:',
        'attribute'=>'walking_count',
        'format'=>'raw',

        'displayOnly'=>true
    ],
    [
        'label'=>'Dołączył:',
        'attribute'=>'join_date',
        'format'=>'raw',
        'displayOnly'=>true
    ],
    [
        'label'=>'Sposób komunikacji:',
        'attribute'=>'from_medium',
        'model'=>$model,
        'value'=>$medium[$model->from_medium],
        'displayOnly'=>true
    ],
    [
        'label'=>'Przywiązanie:',
        'attribute'=>'assignment',
        'model'=>$model,
        'displayOnly'=>true
    ],
    [
        'label'=>'Przywiązanie 2:',
        'attribute'=>'assignment2',
        'model'=>$model,
        'displayOnly'=>true
    ],
    [
        'label'=>'Przywiązanie 3:',
        'attribute'=>'assignment3',
        'model'=>$model,
        'displayOnly'=>true
    ],
    [
        'attribute'=>'sex',
        'label'=>'Płeć',
        'format'=>'raw',
        'value'=>$model->sex==1?'Kobieta':'Mężczyzna',
        'widgetOptions'=>[
            'pluginOptions'=>[
                'onText'=>'Yes',
                'offText'=>'No',
            ]
        ]
    ],
];

$attributes2=[[
    'label'=>'Nazwa trasy',
    'attribute'=>'title',
    'format'=>'raw',
    'displayOnly'=>true
]];


echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Dane personalne',
            'content' => DetailView::widget([
                'model'=>$model,
                'attributes'=>$attributes,
                'deleteOptions'=>[ // your ajax delete parameters
                    'params' => ['id' => $model->id, 'custom_param' => true],
                ],
            ]),
            'active' => true,
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Starty biegacza',
            'content' => GridView::widget([
                'dataProvider'=>$result,
                'columns' => [
                    [
                        'label'=>"Tytuł",
                        'attribute'=>'title',
                        'value'=>function($data){
                            $maraton=\app\models\Marathons::findOne(['id'=>$data->idm]);
                            return $maraton['title'];
                        },
                    ],
                    [
                        'label'=>"Status",
                        'attribute'=>'status',
                        'value'=>function($data) use($marathon_status){
                            return $marathon_status[$data['status']];
                        },
                    ],
                    [
                        'label'=>"Wyprzedzenie",
                        'attribute'=>'passing',
                    ]
                ]
            ]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID2'],
        ],
        [
            'label' => 'Historia rozmów z biegaczem',
            'content' => GridView::widget([
                'dataProvider'=>$history,
                'columns' => [
                    [
                        'label'=>"Tytuł",
                        'attribute'=>'message_title',
                    ],
                    [
                        'label'=>"Treść",
                        'attribute'=>'message_content',
                    ],
                    [
                        'label'=>"Czas",
                        'attribute'=>'datetime_history',
                    ],
                ]
            ]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID3'],
        ],
        [
            'label' => 'Spis przypominajek',
            'content' => GridView::widget([
                'dataProvider'=>$reminder,
                'columns' => [
                    [
                        'label'=>"Notatka",
                        'attribute'=>'note',
                    ],
                    [
                        'label'=>"Czas przypomnienia",
                        'attribute'=>'datetime_reminder',
                    ],
                ]
            ]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID4'],
        ],
    ],
]);





/*
echo ListView::widget([
    'dataProvider' => $list,
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    //'layout' => "{items}",
    'itemOptions' => ['class' => 'item', 'style' => 'margin-bottom: 5px;'],

]);
*/


?>

