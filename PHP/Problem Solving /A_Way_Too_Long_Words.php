<?php
$t = (int) readline();
for ($i = 0; $i < $t; $i++) {
    $s = readline();
    $size = strlen($s);
    $sizeTwo = $size - 2;
    if ($size > 10) {
        echo $s[0] . $sizeTwo . $s[$size - 1]."\n";
    } else {
        echo $s."\n";
    }
}