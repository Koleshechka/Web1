<?php

function validateX($x) {
    $x_max = 4;
    $x_min = -4;

    if (!isset($x))
        return false;

    $numX = str_replace(',', '.', $x);
    return is_numeric($numX) && $numX >= $x_min && $numX <= $x_max;
}

function validateY($y) {
    $y_max = 5;
    $y_min = -5;

    if (!isset($y))
        return false;

    $numY = str_replace(',', '.', $y);
    return is_numeric($numY) && $numY >= $y_min && $numY <= $y_max;
}

function validateR($r) {
    return isset($r);
}

function validate($x, $y, $r) {
    return validateX($x)&&validateY($y)&&validateR($r);
}

function checkTriangle($x, $y, $r) {
    return $x >= 0 && $y >= 0 && $x <= $r/2 && $y <= $r;
}

function checkRectangle($x, $y, $r) {
    return $x <= 0 && $y >= 0 && $x >= -$r && $y <= $r;
}

function checkCircle($x, $y, $r) {
    return $x >= 0 && $y <= 0 && $x*$x+$y*$y <= $r/2*$r/2;
}

function checkHit($x, $y, $r) {
    return checkTriangle($x, $y, $r)||checkRectangle($x, $y, $r)||checkCircle($x, $y, $r);
}

$start = microtime(true);
$r = (int)$_GET["r"];
$x = (float)$_GET["x"];
$y = (float)$_GET["y"];
$isValid = validate($x, $y, $r);
$hit = $isValid ? checkHit($x, $y, $r) : "Невалидные данные";
$hit = $hit ? 'Точное попадание' : 'Промах';
$current_time = date('H:i:s', time()-$_GET['time']*60);
$script_time = (microtime(true)-$start);

$jsonData = "{".
    "\"x\":\"$x\",".
    "\"y\":\"$y\",".
    "\"r\":\"$r\",".
    "\"currentTime\":\"$current_time\",".
    "\"scriptTime\":\"$script_time\",".
    "\"hit\":\"$hit\"".
    "}";

header('Access-Control-Allow-Origin: *');
echo $jsonData;
