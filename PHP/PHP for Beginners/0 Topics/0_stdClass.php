<?php
// The stdClass class: A generic empty class with dynamic properties.
// 1:Objects of this class can be instantiated with new operator or created by typecasting to object. 
// 2:This class has no methods or default properties.



//Example #1 Created as a result of typecasting to object
$objOne = (object) ['foo' => 'bar', 'test' => 1, 'test3' => 2];
var_dump($objOne);

//Example #2 Created as a result of json_decode()
$json = '{"foo":"bar"}';
$s1 = json_decode($json);
var_dump($s1);

//Example #3 Declaring dynamic properties
$objTwo = new stdClass();
$objTwo->foo = 42;
$objTwo->{1} = 42;
var_dump($objTwo);

//Example #4 Using stdClass as a generic object
$objThree = new stdClass();
$objThree->name = 'John';
$objThree->age = 30;
$objThree->greet = function() {
    return "Hello, my name is {$this->name} and I am {$this->age} years old.";
};
var_dump($objThree);

?>