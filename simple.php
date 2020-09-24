<?php

function getFactors($number1)
{
    $number = $number1;
    $i = 2;
    $arr = [];
    while ($i < round(sqrt($number1))) {
        $iter++;
        if (!($number % $i)) {
            $arr[] = $i;
            $number /= $i;
        } else {
            $i++;
        }
        echo "num = $number<br>";
        if ($number == 1) break;
    }
    echo $iter.'<br>';
    return $arr;
}