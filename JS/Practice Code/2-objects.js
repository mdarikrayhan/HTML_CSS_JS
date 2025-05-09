//Factory Function
function createPerson(total, firstName, lastName, age) {
    const person = {
        firstName: firstName,
        lastName: lastName,
        age: age,
        fullName: function() {
            return this.firstName + " " + this.lastName;
        }
    }
    return person;
}
const anotherPerson = createPerson(50, "John", "Doe", 41)
console.log(anotherPerson.age)

// console.log(person.age, person.fullName())

//new Keyword
const person = new Object()
person.firstName = "John";
person.lastName = "Doe";
person.age = 42;
person.fullName = function() {
    return this.firstName + " " + this.lastName;
}
// console.log(person.age, person.fullName())

//Using constructor function
function Person(first, last, age, eye) {
    this.firstName = first;
    this.lastName = last;
    this.age = age;
    this.eyeColor = eye;
}
const person2 = new Person("John", "Doe", 42, "blue");
