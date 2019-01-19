<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Edycja trasy';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
        'id' => 'operator-form',
        'layout' => 'horizontal',
    ]);

    ?>

        <?= $form->field($model, 'title')->textInput()->label('Tytuł') ?>
        <?= $form->field($model, 'distance')->textInput()->label('Dystans') ?>
        <?= $form->field($model, 'place')->textInput()->label('Miejsce') ?>
        <?= $form->field($model, 'date_term')->textInput()->label('Data biegu') ?>
        <?= $form->field($model, 'time_term')->textInput()->label('Czas biegu') ?>
        <?= $form->field($model, 'start_register')->textInput()->label('Start rejestracji') ?>
        <?= $form->field($model, 'end_register')->textInput()->label('Koniec rejestracji') ?>
        <?= $form->field($model, 'road_type')->textInput()->label('Typ drogi') ?>
        <?= $form->field($model, 'limit_time_on_road')->textInput()->label('Limit czasu na trasie') ?>
        <?= $form->field($model, 'link')->textInput()->label('Link do wydarzenia') ?>
        <?= $form->field($model, 'link_road')->textInput()->label('Link do trasy biegu') ?>
        <?= $form->field($model, 'buy')->textInput()->label('Opłata startowa') ?>
        <?= $form->field($model, 'available')->textInput()->label('Limit miejsc') ?>
        <?= $form->field($model, 'attention')->textarea()->label('Uwagi') ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
    </div>
</div>