<?php
$string = "Hello, World!";
$integer = 42;
$float = 3.14;
$boolean = true;
$array = array("apple", "banana", "cherry");
$object = new stdClass();
$null = null;

echo "String: $string\n";
echo "Integer: $integer\n";
echo "Float: $float\n";
echo "Boolean: " . ($boolean ? 'true' : 'false') . "\n";
echo "Array: " . implode(", ", $array) . "\n";
echo "Object: " . json_encode($object) . "\n";
// Demonstrating variable types in PHP
echo "Null: " . ($null === null ? 'null' : $null) . "\n";

var_dump($string);// Displaying the type and value of the variable


?>