<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Dodawanie nowego operatora';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
        'id' => 'operator-form',
        'layout' => 'horizontal',
    ]);

    $connection = Yii::$app->getDb();
    $command = $connection->createCommand("select max(id) as maxik from operator");
    $result = $command->queryAll();

    ?>

        <?= $form->field($model, 'username')->textInput()->label('Login') ?>

        <?= $form->field($model, 'name')->textInput()->label('Imię') ?>

        <?= $form->field($model, 'surname')->textInput()->label('Nazwisko') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Hasło') ?>
        <!--
        <?= $form->field($model,'authKey')->hiddenInput(['value'=> "test".$result[0]['maxik']."key"]) ?>

        <?= $form->field($model,'accessToken')->hiddenInput(['value'=> $result[0]['maxik']."-token"]) ?>
            -->
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">

    </div>
</div>
