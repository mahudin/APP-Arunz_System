<?php
use app\models\Marathons;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.04.2017
 * Time: 00:32
 */

$date=$payment;

$maraton=Marathons::findOne(["id"=>$date->idm]);

echo '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"/>
</head>
<body>
<br/>


<h2 style="font-family: \"Open Sans\", sans-serif!important;">Drogi Biegaczu!</h2><br/>
<p style="\font:normal 16px "Open Sans", sans-serif!important; width:400px;\">
    Zapisałeś się na bieg '.$maraton->title.', pobraliśmy płatność w wysokości '.$date->payment_cash.' złotych. <br/>
    Skup teraz na przygotowaniach, my zajmiemy się resztą:<br/>

    Przed startem prześlemy ci:
<ul>
    <li> 1. Informacje o trasie i pogodzie </li>
    <li> 2. Wszelkie niezbędne wskazówki, tak byś dobiegł na metę zadowolony </li>
    <li> 3. Przypomnienie o starcie wraz z informacją jak dotrzeć na start </li>
</ul>
<br/>
Na twoje specjalne życzenie:<br/>
Zakupimy ci bilety na podróż w obie strony oraz znajdziemy odpowiedni nocleg<br/>
a w razie innych życzeń będziemy działać, tak abyś ty skupił się na biegu.

<br/><br/>
Udanych startów!<br/>
<span style="color:#673AB7"><b>Zespół ArunZ</b></span>
<br/><br/>
<hr/>
Jeśli potrzebujesz pomocy technicznej, napisz do nas:<br/>
kontakt@arunz.eu
<br/>
</p>
</body>
</html>';
?>