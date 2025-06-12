<?php
trait PersonTrait {
    public $name;
    public $age;

    function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    function greet() {
        echo "Hello, my name is " . $this->name . " and I am " . $this->age . " years old.";
    }
}

class Person {
    use PersonTrait;
}

$persons = array(
    new Person("Alice", 30),
    new Person("Bob", 25),
    new Person("Charlie", 35),
    new Person("Diana", 28),
    new Person("Ethan", 22)
);

// Function to greet all persons in the array
function greetAll($persons) {
    foreach ($persons as $person) {
        $person->greet();
        echo "\n";
    }
}

// Call the function to greet all persons
greetAll($persons);
// Output:
// Hello, my name is Alice and I am 30 years old.