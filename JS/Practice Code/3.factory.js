//Factory Function
function createPerson(total, firstName = "John", lastName = "Doe", age = 42) {
    const people = [];
    for (let i = 0; i < total; i++) {
        const person = {
            firstName: firstName,
            lastName: lastName,
            age: age,
            fullName: function() {
                return this.firstName + " " + this.lastName;
            }
        };
        people.push(person);
   } 
    return people;
}

// Example usage
const people = createPerson(5, "Jane", "Smith", 30);
console.dir(people[0]); // { firstName: 'Jane', lastName: 'Smith', age: 30, fullName: [Function] }

// Example of default values
const peopleWithDefaults = createPerson(3);
console.log(peopleWithDefaults[0]); // { firstName: 'John', lastName: 'Doe', age: 42, fullName: [Function] }
