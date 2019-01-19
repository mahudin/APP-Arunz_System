<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="scripts/main.js"></script>
    <style>
        .row-invisible{
            display:none;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ArunZ - system wewnętrzny',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'style'=>"background-color:#673ab7;color:white!important;"
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right','style'=>"background-color:#673ab7;ccolor:white!important;"],
        'items' => [
            ['label' => 'Strona główna', 'url' => ['/site/index'],'style'=>"color:white!important;"],
            ['label' => 'Biegacze', 'url' => ['/site/runners'],'style'=>"color:white!important;"],
            ['label' => 'Biegi', 'url' => ['/roads/index'],'style'=>"color:white!important;"],
            Yii::$app->user->isGuest ? (
                ['label' => 'Zaloguj się', 'url' => ['/site/login'],'style'=>"opacity:0.7;"]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Wyloguj się (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout','style'=>"opacity:0.7;"]
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    <input type="hidden" id="hidden_id" value="<?php echo Yii::$app->user->getId(); ?>">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>



</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
