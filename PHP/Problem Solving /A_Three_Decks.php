<?php
$t = (int) readline();
for ($i = 0; $i < $t; $i++) {
    $ans = 0;
    $min = 0;
    $tmem = 1;

    list($n, $x) = explode(' ', readline());
    $arr = explode(' ', readline());

    for ($j = 0; $j <$n; $j++) {
        $arr[$j] = (int) $arr[$j];
    }


    sort($arr);
    for ($j = $n-1; $j>=0; $j--) {
        if($min === 0){
            $min = $arr[$j];
        }
        if($min> $arr[$j]){
            $min = $arr[$j];
        }
        $power = $min * $tmem;
        if($power>=$x){
            $min = 0;
            $tmem = 1;
            $ans++;
        }
        else{
            $tmem++;
        }
    }
    echo $ans."\n";
}