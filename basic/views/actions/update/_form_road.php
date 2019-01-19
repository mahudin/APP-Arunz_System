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
use \app\models\UsersOfMarathons;

$marathon_status=[1=>"Przyjęliśmy Twoje zgłoszenie na bieg",2=>"Zostałeś dodany do losowania!",3=>"Zostałaś zapisana na bieg! Szykuj się do startu"];


echo GridView::widget([
    'dataProvider'=>$resulterek,
    'columns' => [
        [
            'attribute'=>'id',
            'contentOptions' => ['class' => 'row-invisible'],
            'headerOptions' => ['class' => 'row-invisible'],
        ],
        [
            'label'=>"Tytuł",
            'attribute'=>'title',
            'value'=>function($data){
                return Marathons::findOne(['id'=>$data->idm])['title'];
            },
        ],
        [
            'class' =>  EditableColumn::className(),
            'label'=>"Status",
            'attribute'=>'status',
            'headerOptions' => ['class' => 'kv-sticky-column'],
            'url' => ['change-status-marathon-for-user'],
            'value'=>function($data) use($marathon_status){
                return $marathon_status[$data['status']];
            },
            'type' => 'select',
            'editableOptions' => function ($model) use($marathon_status) {
                return [
                    'source' => $marathon_status,
                    'value'=> $marathon_status[$model['status']]
                    ,
                ];
            },
        ],
        [
            'attribute'=>'passing',
            'value'=>function($data) use($marathon_status){
                if($data['status'] == 3 && $data['passing'] == null){
                    return UsersOfMarathons::count_and_save_course($data['idm'],$data['id']);
                } else if($data['passing']!=""){
                    return $data['passing'];
                } else {
                    return "";
                }
            },
        ]
        ,
        ['class' => 'kartik\grid\CheckboxColumn']
    ],'panel'=>[
    'before'=>false,
    'footer'=>false,
    'after'=>
        Html::button('<i class="glyphicon glyphicon-remove"></i> Usuń', ['type'=>'button', 'class'=>'btn btn-danger kv-batch-delete delete_marathon_for_user']) . ' '
],
]);

 echo Select2::widget([
    'model' => $result,
    'name'=>'title',
    'id'=>'selector_marathon',
    'data' => ArrayHelper::map(\app\models\Marathons::find()->all(), 'id', 'title'),
    'options' => ['placeholder' => 'Wybierz maraton ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
    'pluginEvents'=>[
        'change'=>
            ' function(){
                var id_trasa=$(this).val();
                var trasa_jest_juz_u_biegacza=false;

                $("#myveryownID2 tr td:first-child").each(function(){
                    if($(this).html()==id_trasa){
                        trasa_jest_juz_u_biegacza=true;
                    }
                });

                if(!trasa_jest_juz_u_biegacza && id_trasa!=null && id_trasa!=undefined){

                        $.ajax({
                            data:{
                                id_trasy:id_trasa,
                                id_user:$("#id_userka").val()
                            },
                            url: "index.php?r=site%2Faddmarathontouser",
                            error: function(data) {
                                console.log(data);
                            },
                            success: function(data) {

                                if(data=="ok"){
                                    localStorage.setItem("lastTab",2);
                                    location.reload();
                                } else {
                                    alert("Wystąpił błąd przy dodawaniu trasy do użytkownika, spróbuj jeszcze raz!");
                                    $("#selector_marathon").val("");
                                    localStorage.setItem("lastTab",2);
                                    location.reload();
                                }
                            }
                        });
                } else {
                    alert("Bieg ten już istnieje w spisie biegacza!");
                    $("#selector_marathon").val("");
                    localStorage.setItem("lastTab",2);
                    location.reload();

                }

              }'
    ]
]);


