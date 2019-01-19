<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\web\JsExpression;
//use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Dialog;
use dosamigos\datetimepicker\DateTimePicker;

$this->title = 'ArunZ- System wewnętrzny';


/*$events = array();
//Testing
$Event = new \yii2fullcalendar\models\Event();
$Event->id = 1;
$Event->title = 'Testing';
$Event->start = date('Y-m-d\TH:i:s\Z');
$Event->editable=true;

$event->nonstandard = [
    'field1' => 'Something I want to be included in object #1',
    'field2' => 'Something I want to be included in object #2',
];
  $events[] = $Event;

  $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 2;
  $Event->title = 'Testing';
  $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
  $events[] = $Event;*/

$JSCodeHover = <<<EOF

function(event, delta, revertFunc) {

        if (!confirm("Jesteś pewien że chcesz dokonać zmiany dla przypomnienia ?")) {
            revertFunc();
        } else {
            date = new Date(event.start);
             datevalues =
                    date.getFullYear()+"-"+
                    ( (date.getMonth()+1)<=9? "0"+(date.getMonth()+1) : (date.getMonth()+1) )
                    +"-"+
      ( (date.getDate())<=9?    "0"+(date.getDate()) : (date.getDate()) )+" "+
      ( (date.getHours()-1)<=9? "0"+(date.getHours()-1) : (date.getHours()-1) )+":"+
      ( (date.getMinutes())<=9? "0"+(date.getMinutes()) : (date.getMinutes()) )+":"+
      ( (date.getSeconds())<=9? "0"+(date.getSeconds()) : (date.getSeconds()) );

            $.ajax({
              url: 'index.php?r=site/changedatereminder',
              type: 'post',
              data: {
                 id:  event.id,
                 datetimer: datevalues ,
              },
              error: function (data) {
                console.log(data);
              },
              success: function (data) {

              }
            });
        }
}
EOF;

$JSCode = <<<EOF

    function(start,end) {
        //alert ($("select[id=catid] option:selected").text());
        var title = $("select[id=codePers] option:selected");
        var codePersonnel = $("select[id=codePers] option:selected").val();
        var posteId = $("select[id=postId] option:selected").val();
        var categorieID = $("select[id=catId] option:selected").val();
        //alert($('#catid').val());
        var eventData;

        alert("cholera");


    }

EOF;

$JSEventClick = <<<EOF
function(calEvent, jsEvent, view) {

    $("#dialog").dialog({
        title:"Zarządzanie przypominajką",
        autoOpen: false,
        height: 80,
        width: 300,
        modal: true,
        buttons: {
            'Zmień note': function () {
                var title = prompt('Event Title:',calEvent.title);
                var eventData;
                if (title) {
                    $.ajax({
                        url: 'index.php?r=site/changenotereminder',
                        type: 'post',
                        data: {
                            id:  calEvent.id,
                            note: title ,
                        },
                        error: function (data) {
                            console.log(data);
                        },
                        success: function (data) {
                            calEvent.title=title;
                            $('#w0').fullCalendar('refetchEvents');
                        }
                    });
                }
                calEvent.title=title;
                $('#w0').fullCalendar('refetchEvents');
                $(this).dialog('close');
            },
            'Usuń':function() {
                if(confirm("Jesteś pewien że chcesz usunąć daną przypominajke ?")){
                    $.ajax({
                        url: 'index.php?r=site/deletereminder',
                        type: 'post',
                        data: {
                            id:  calEvent.id,
                        },
                        error: function (data) {
                            console.log(data);
                        },
                        success: function (data) {
                            if(data=="ok"){
                                $(this).dialog('close');
                                location.reload();
                            }
                        }
                    });
                    $('#w0').fullCalendar('refetchEvents');
                    $(this).dialog('close');
                }
            },
            'Anuluj': function () {
                $('#w0').fullCalendar('refetchEvents');
                $(this).dialog('close');
            }
        },
        close: function () {
            $('#w0').fullCalendar('refetchEvents');
        }
    });

    $("#dialog").dialog('open');



    /*$('confirm text').dialog(
    {
        modal:true, //Not necessary but dims the page background
        buttons:{
            'Save':function() {
                //Whatever code you want to run when the user clicks save goes here
             },
             'Delete':function() {
                 //Code for delete goes here
              }
        }
    }
    );*/

    $('#w0').fullCalendar('refetchEvents');
}
EOF;



?>

<div class="site-index">


<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
    'options' => [
        'lang' => 'pl',
    ],
    'clientOptions'=>[
        'selectHelper' => true,
        'eventClick' => new JsExpression($JSEventClick),
        'eventDrop'=>new JsExpression($JSCodeHover),
        'select'=>new JsExpression($JSCode),
        'droppable' => true,
        'editable' => true,
    ],
    'ajaxEvents' => Url::to(['/site/jsoncalendar'])
));
?>

    <div id="dialog"></div>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11"><br/>
            <?= Html::input("button","add_reminder_default","Dodaj przypominajke ogólną",['class' => 'btn btn-primary','id'=>"add_new_reminder_default"]) ?>
        </div>
    </div>

<?php    Dialog::begin([
    'clientOptions' => [
        'modal' => true,
        'autoOpen' => false,
        'title' => 'Dodanie nowej przypominajki ogólnej',
        'width' => '350px',
        'pjax'=>true,
        'buttons' => [
            [
                'class'=>   "btn btn-default",
                'text' => 'Dodanie nowej przypominajki ogólnej',
                'onclick' =>'
                    $.ajax({
                        data:{
                            note:$("#new_reminder_title").val(),
                            datetime:$("#new_reminder_datetime").val(),
                            id_operator:$("#hidden_id").val(),
                            idu:0,
                    },
                    url: "index.php?r=site%2Faddreminder",
                    error: function(data) {
                        console.log(data);
                    },
                    success: function(data) {
                        if(data=="ok"){
                            $("#new_reminder_dialog").dialog("close");
                            $(\'#w0\').fullCalendar(\'refetchEvents\');
                        } else {
                            alert("Wystąpił błąd przy dodawaniu notatki, spróbuj jeszcze raz!");
                        }
                    }
            });'
            ],
    ],
    ],
    'id' => 'new_reminder_dialog',
    ]);

    echo '
    <table id="datas-form">


        <tr>
            <td>Treść przypominajki</td><td><textarea class="form-control" id="new_reminder_title"></textarea></td>
        </tr>
        <tr>
            <td><br/></td><td></td>
        </tr>
        <tr>
            <td>Data i czas</td>
            <td>';
/*
echo DateTimePicker::widget([
    //'id'=>'new_reminder_datetime',
    'name' => 'dp_2',
    //'convertFormat' => true,
    'type' => DateTimePicker::TYPE_INPUT,
    'value' => '23-Feb-1982 10:10',
    //'language'=>'pl',
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss'
    ]
]);*/
echo DateTimePicker::widget([
    'id'=>'new_reminder_datetime',
    'name'=>"dp_2",
    'attribute' => 'created_at',
    'language' => 'pl',
    'size' => 'ms',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd hh:ii:ss',
        'todayBtn' => true
    ]
]);
            echo '
            </td>
        </tr>
    </table>
    ';

    Dialog::end();
    ?>

</div>
