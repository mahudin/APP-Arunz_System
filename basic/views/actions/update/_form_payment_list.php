<?php
use kartik\detail\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii2mod\editable\EditableColumn;
use \app\models\Marathons;

$marathon_status=[1=>"Przyjęliśmy Twoje zgłoszenie na bieg",2=>"Zostałeś dodany do losowania!",3=>"Zostałaś zapisana na bieg! Szykuj się do startu"];


echo GridView::widget([
    'dataProvider'=>$model,
    'columns' => [
        'payment_id',
        'payment_status',
        'payment_cash',
        'datetime_payment',
        [
            'attribute'=>"Link",
            'header'=>'Link',
            'value'=>function($date){
                return Html::a("Link","index.php?r=site%2Fcreatepdf&id=".$date['id']);
            },
            'format'=>'raw'
        ]

    ],'panel'=>[
    'before'=>false,
    'footer'=>false,

]]);



