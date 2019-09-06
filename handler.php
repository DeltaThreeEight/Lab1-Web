<!DOCTYPE html>
<html>
<head>
	<title>Результат проверки</title>
  	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/handler_style.css">
</head>
<body>
<?php
session_start();

$start = microtime(true);
$currentTime = date("H:i:s", strtotime('+3 hour'));

$x=(int)$_GET['x_h'];
$y=(float)$_GET['y_h'];
$r=(float)$_GET['r_h'];
$load=$_GET['load'];

$check = 'F';

if (strcmp($load, "yes") == 0) {
    printTable(10); //Загрузка таблицы и хранение последних N запросов
} else {
    if (!validate($x, $y, $r)) {
        array_push($_SESSION['arr'], "<tr> <td colspan='8'><b>Неверные аргументы</b></td> </tr>");
    } else {
        if (check($x, $y, $r))
            $check = 'T';
        else
            $check = 'F';

        $_SESSION['i']++;
        $n = $_SESSION['i'];
        $time = round((microtime(true) - $start) * 1000, 3);

        array_push($_SESSION['arr'], "<tr> <td>$n</td> <td>$x</td> <td>$y</td> <td>$r</td> <td><b>$check</b></td> <td>$currentTime</td>  <td>$time  мс</td>  <td><button onclick='parent.markPoint($x, $y, $r)'>+</button></td></tr>");
    }

    printTable(10);

}

function check($x, $y, $r) {
    if (($x >= (-$r) & $y >= (-$r) & $y <= 0 & $x <= 0) || ($y >= ($x / 2 - $r / 2) & $y <= 0 & $x >= 0 & $x <= $r) || ((pow($x, 2) + pow($y, 2) <= (pow($r / 2, 2))) & $y >= 0 & $x <= 0))
        return true;
    return false;
}

function validate($x_arg, $y_arg, $r_arg)
{
    if (!(is_numeric($x_arg) && is_numeric($y_arg) && is_numeric($r_arg))) return false;

    $x_values = array(-4, -3, -2, -1, 0, 1, 2, 3, 4);
    $r_values = array(1, 1.5, 2, 2.5, 3);

    if (!in_array($x_arg, $x_values)) return false;
    if ($y_arg < -3 || $y_arg > 5) return false;
    if (!in_array($r_arg, $r_values)) return false;

    return true;
}

function printTable($limit) {
    echo "<table class=\"results\">";
    echo "<tr> <th>N</th> <th>X</th> <th>Y</th> <th>R</th> <th><b>Результат</b></th> <th>Время</th> <th>Время работы скрипта </th> <th>Показать </th> </tr>";

    while (count($_SESSION['arr']) >= $limit) array_shift($_SESSION['arr']);

    foreach ($_SESSION['arr'] as $item) {
        echo str_replace('F', "Промах", str_replace('T', "Попадание",$item));
    }

    echo "</table> <br>";

    return;
}

?>
</body>
</html>