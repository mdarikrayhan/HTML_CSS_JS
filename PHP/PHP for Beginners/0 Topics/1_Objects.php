<?php
#Example 1 Object Construction
class foo
{
    function do_foo()
    {
        echo "Doing foo.";
    }
}

$bar = new foo;
$bar->do_foo();

#Example #2 Casting to an Object
$obj = (object) array('1' => 'foo');
var_dump(isset($obj->{'1'})); // outputs 'bool(true)'

// Deprecated as of PHP 8.1
var_dump(key($obj)); // outputs 'string(1) "1"'

#Example #3 (object) cast

?>

