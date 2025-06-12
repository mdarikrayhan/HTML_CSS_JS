<?php 
interface PersonInterface {
    public function greet();
    public function getAge($randomInt):int|float|string;
}
interface PersonExtra {
    public function getAge(): bool;
}
interface PersonMain extends PersonInterface {
    public function getAge($randomInt): int;
}

//Creating an person object
class Person implements  PersonExtra, PersonMain {
    public $name;
    public $age;

    function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    function greet() {
        echo "Hello, my name is " . $this->name . " and I am " . $this->age . " years old.";
    }
    // function getAge($randomInt): int {
    //     // This function is required by the interface, but we can ignore $randomInt for this example
    //     return $this->age;
    // }
    function getAge(): bool {
        // This function is also required by the interface, but we can ignore it for this example
        return true;
    }

}
// Creating object array with 5 persons
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
        echo "<br>";
    }
}
?>