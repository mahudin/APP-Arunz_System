<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12.03.2017
 * Time: 23:32
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
//use kartik\widgets\DateTimePicker;
use dosamigos\datetimepicker\DateTimePicker;
use yii\bootstrap\ActiveForm;

echo '<label class="control-label">Treść przypomnienia</label>';
echo '<br/><textarea  class="form-control" name="dp_1" id="dp_1"></textarea><br/><br/>';

echo '<label class="control-label">Data i czas</label>';
echo DateTimePicker::widget([
    'id'=>'dp_2',
    'name' => 'dp_2',
    'attribute' => 'created_at',
    'language' => 'pl',
    'size' => 'ms',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd hh:ii:ss',
        'todayBtn' => true
    ]
]);
/*echo DateTimePicker::widget([
    'id'=>'dp_2',
    'name' => 'dp_2',
    'type' => DateTimePicker::TYPE_INPUT,
    'language'=>'pl',
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss'
    ]
]);*/
echo '<br/><input type="button" id="create_reminder" class="btn btn-default" value="Utwórz przypomnienie"><br/><br/>';