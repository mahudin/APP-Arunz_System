<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

    $form = ActiveForm::begin([
        'id' => 'operator-form','layout' => 'horizontal',
    ]);
?>
<?= $form->field($model, 'nr_card')->textInput()->label('Numer karty') ?>
<?= $form->field($model, 'date_card')->textInput()->label('Data karty') ?>
<?= $form->field($model, 'uname_card')->textInput()->label('Imię właściciela karty') ?>
<?= $form->field($model, 'surname_card')->textInput()->label('Nazwisko właściciela karty') ?>
<?= $form->field($model, 'cvv_cvc')->textInput()->label('CVV/CVC') ?>



    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Popraw dane', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<hr/>
    <div class="form-group">
        <div class="col-lg-5">

            <?= Html::button('Autoryzuj kartę', ['class' => 'btn btn-primary','id'=>"get_auth_card_user"]) ?>
            <?= Html::button('Pobierz płatność', ['class' => 'btn btn-primary','id'=>"get_payment_user"]) ?>

            <div class="row">
                <div class="col-lg-6"><br/><br/>
                    <?= Html::input("input","kwota",null,['class'=>'form-control','placeholder'=>"Kwota",'id'=>'form_kwota']) ?>
                </div>
                <div class="col-lg-6"><br/><br/>
                    <?= Html::input("input","procent",null,['class'=>'form-control','placeholder'=>"Procent",'id'=>'form_procent']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6"><br/>
                    <?= Html::input("button","oblicz","Oblicz procent z liczby",['class'=>'btn btn-primary','id'=>'form_count_from_percent']) ?>
                    =>
                </div>
                <div class="col-lg-6"><br/>
                    <?= Html::input("input","wynik",null,['class'=>'form-control','placeholder'=>"Wynik",'id'=>'form_final_result']) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <br/><textarea  class="form-control" style="min-height:80px;" name="dp_1" id="show_results_textarea"></textarea><br/>
            <div class="col-lg-1">
            <?= Html::checkbox("is_send_mail_to_user",false,['id'=>"is_send_mail_to_user"]) ?>
            </div>
            <div class="col-lg-11">
                W przypadku dokonania pomyślnej płatności wysłanie wiadomości mailowej do użytkownika
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>