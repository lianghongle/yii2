<?php

$str = 'abcd';
$len = strlen($str);
for ($i = $len; $i > 0; --$i){
    var_dump($i);
    var_dump($str[$i - 1]);
}