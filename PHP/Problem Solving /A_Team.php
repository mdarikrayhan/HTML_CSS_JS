<?php
$n = (int) readline();
$ans = 0;
for ($i = 0; $i < $n; $i++) {
    $sum = 0;
    fscanf(STDIN, "%d %d %d", $p, $v, $t);
    if ($p + $v + $t>=2) {
        $ans++;
    }
}
echo $ans . "\n";