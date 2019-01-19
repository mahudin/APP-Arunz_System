<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22.02.2017
 * Time: 22:35
 */
use kartik\detail\DetailView;
//use yii\grid\GridView;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
use yii\helpers\Html;
use kartik\widgets\InputWidget;
use kartik\editable\Editable;
use kartik\grid\EditableColumnAction;
use yii\jui\Dialog;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

$this->title='Edycja biegacza - '.$model->uname." ".$model->surname; // ;
$this->params['breadcrumbs'][]=['label'=>'Biegacze', 'url'=>['site/runners']];
$this->params['breadcrumbs'][]=$this->title;



echo '<input type="hidden" id="id_userka" value="'.$model->id.'"/>';
?>


<?php


$list1=GridView::widget([
    'id'=>"example",
    'dataProvider'=>$history,
    'columns' => [
        [
            'attribute'=>'id',
            'label'=>'#',
            'contentOptions' => ['class' => 'row-invisible'],
            'headerOptions' => ['class' => 'row-invisible'],
        ],
        [
            'class' => \yii2mod\editable\EditableColumn::className(),
            'label'=>"Tytuł",
            'attribute'=>'message_title',
            'url' => ['change-message-content-interview'],
        ],
        [
            'class' => \yii2mod\editable\EditableColumn::className(),
            'label'=>"Treść",
            'attribute' => 'message_content',

            'url' => ['change-message-content-interview'],
        ],
        [
            'label'=>"Czas",
            'attribute'=>'datetime_history',
        ],
        ['class' => 'kartik\grid\CheckboxColumn']
    ],

        'panel'=>[
            'before'=>false,
            'footer'=>false,
            'after'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Dodaj nową notatke', ['type'=>'button', 'class'=>'btn btn-success kv-batch-create add_interview']) . ' ' .
                Html::button('<i class="glyphicon glyphicon-remove"></i> Usuń', ['type'=>'button', 'class'=>'btn btn-danger kv-batch-delete delete_interview']) . ' '
        ],
]);




echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Dane personalne',
            'content' => $this->render('_form_runner', ['model' => $model]),
            'active' => true,
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Starty biegacza',
            'content' => $this->render('_form_road', ['resulterek' => $resulter]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID2'],
        ],
        [
            'label' => 'Historia rozmów z biegaczem',
            'content' => $list1,
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID3'],
        ],
        [
            'label' => 'Nowa przypominajka',
            'content' => $this->render('_form_reminder', ['reminder' => $reminder]) ,
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID4'],
        ],
        [
            'label' => 'Płatności',
            'content' => $this->render('_form_payment', ['model' => $model]) ,
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID5'],
        ],
        [
            'label' => 'Płatności biegacza',
            'content' => $this->render('_form_payment_list', ['model' => $list]) ,
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID6'],
        ],
    ],
]);

Dialog::begin([
    'clientOptions' => [
        'modal' => true,
        'autoOpen' => false,
        'title' => 'Dodanie nowej historii',
        'width' => '250px',
        'pjax'=>true,
        'buttons' => [
            [

                'text' => 'Dodanie nowej historii',
                'onclick' =>'
                        $.ajax({
                            data:{
                                message_title:$("#new_title").val(),
                                message_content:$("#new_content").val(),
                                id_operator_history:$("#hidden_id").val(),
                                id_runner_history:'.$model->id.',
                            },
                            url: "index.php?r=site%2Faddinterview",
                            error: function(data) {
                                console.log(data);
                            },
                            success: function(data) {
                                if(data=="ok"){
                                    $("#new_interview_dialog").dialog("close");
                                    localStorage.setItem("lastTab",3);
                                    location.reload();
                                } else {
                                    alert("Wystąpił błąd przy dodawaniu notatki, spróbuj jeszcze raz!");
                                }
                            }
                        });
                    '
            ],
        ],
    ],
    'id' => 'new_interview_dialog',
]);

echo '
<table id="datas-form">
<tr>
    <td>Tytuł</td><td><input class="form-control" type="text" id="new_title"/><br/></td>
</tr>
<tr>
    <td><br/></td><td></td>
</tr>
<tr>
    <td>Treść</td><td><textarea class="form-control" id="new_content"></textarea></td>
</tr>
</table>
';

Dialog::end();


?>

