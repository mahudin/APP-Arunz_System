<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

    $form = ActiveForm::begin([
        'id' => 'operator-form','layout' => 'horizontal',
    ]);
?>
<?= $form->field($model, 'email')->textInput()->label('Email') ?>
<?= $form->field($model, 'uname')->textInput()->label('Imię') ?>
<?= $form->field($model, 'surname')->textInput()->label('Nazwisko') ?>
<?= $form->field($model, 'sex')->dropDownList([0=>"",1=>"Kobieta",2=>"Mężczyzna"])->label('Płeć') ?>
<?= $form->field($model, 'phone')->textInput()->label('Telefon') ?>
<?= $form->field($model, 'state')->textInput()->label('Województwo') ?>
<?= $form->field($model, 'city')->textInput()->label('Miasto') ?>
<?= $form->field($model, 'street')->textInput()->label('Ulica') ?>
<?= $form->field($model, 'shirt_size')->textInput()->label('Rozmiar koszulki') ?>
<?= $form->field($model, 'from_medium')->dropDownList(["","WhatsApp","Facebook","Messenger"])->label('Sposób komunikacji') ?>
<?= $form->field($model, 'assignment')->textInput()->label('Przywiązanie') ?>
<?= $form->field($model, 'assignment2')->textInput()->label('Przywiązanie 2') ?>
<?= $form->field($model, 'assignment3')->textInput()->label('Przywiązanie 3') ?>
<?= $form->field($model, 'join_date')->textInput()->label('Dołączył') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>