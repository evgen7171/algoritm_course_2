<?php

/** todo
 * 1.скобки, (),{},[],'',""
 * 2.проводник (+ просмотр, удаление, добавление..)
 * 3.разложение на простые множители/найти делители
 */

include 'brackets.php';
include 'explorer.php';
include 'simple.php';

//$str = "{[(e're')d]fjg}66";
//echo checkBrackets($str).PHP_EOL;

//Folder::run('E:');

$num = 152;
echo $num.'<br>';
echo round(sqrt($num)).'<br>';
$arr = getFactors($num);
var_dump($arr);
echo '<br>';

$res = 1;
foreach ($arr as $item){
    $res *= $item;
}
echo $res.'<br>';