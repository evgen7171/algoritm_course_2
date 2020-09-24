<?php
/**
 * функция проверки скобок/кавычек
 * @param $str
 * @return int|null - индекс в сторке, где ошибка или null, если ошибок нет
 */
function checkBrackets($str)
{
    $brackets = ["(" => ")", "[" => "]", "{" => "}"];
    $quotes = ["\"", "'", "`"];
    $arr = new SplStack();
    $errorNumber = null;

    foreach (str_split($str) as $key => $el) {
        if (in_array($el, array_keys($brackets))) {
            $arr->push($el);
        } elseif (in_array($el, array_values($brackets))) {
            if (!$arr->count()) {
                $errorNumber = $key;
            } else {
                $el == $brackets[$arr->top()] ? $arr->pop() : $errorNumber = $key;
            };
        } elseif (in_array($el, $quotes)) {
            if ($arr->top() == $el) {
                $arr->pop();
            } else {
                $arr->push($el);
            }
        }
        if ($errorNumber) {
            break;
        }
    }
    if ($arr->count() && !$errorNumber) {
        $errorNumber = mb_strlen($str);
    }
    return $errorNumber;
}

