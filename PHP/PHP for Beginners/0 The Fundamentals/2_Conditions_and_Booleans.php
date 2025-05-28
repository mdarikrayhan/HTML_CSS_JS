<?php
    $number = 10;
    if($number == 0){
        echo "The number is zero.\n";
    } elseif($number > 0) {
        echo "The number is positive.\n";
    } else {
        echo "The number is negative.\n";
    }
    // Using the ternary operator
    $result = ($number > 0) ? "Positive" : "Not positive";
    echo "The number is: $result\n";

    // Using the null coalescing operator
    $value = null;
    $default = "Default Value";
    $finalValue = $value ?? $default;
    echo "The final value is: $finalValue\n";

?>