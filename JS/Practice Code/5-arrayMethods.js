const fruits = ["Banana", "Orange", "Apple", "Mango"];
console.log("\nOriginal Array:", fruits);

let size = fruits.length;
console.log("\nThe size of the Array:", size);

let stringVar = fruits.toString();
console.log("\nTransform the array to variable:", stringVar);

let thirdFruit = fruits.at(3); //Returns index 3 element
console.log("\nElements at index 3:", thirdFruit);

let defaultJoin = fruits.join();
console.log("\nDefault join uses comma to join:", defaultJoin);
let symbolJoin = fruits.join("+");
console.log("Join using the '+' symbol:", symbolJoin);

let newFruit = "Grape";
fruits.push(newFruit); //Pushes at the end;
console.log("\nPushes the element at the end of the array: ", fruits);

let popElement = fruits.pop();
console.log("\nPop element:", popElement); //Give the last element
console.log("Array after Pop:", fruits);

let fruit = fruits.shift(); //Removes the first element
console.log("\nArray after shit:", fruits);

fruits.unshift("Banana"); //inserts element at the first index
console.log("\nArray after the unshift", fruits);

delete fruits[2];
console.log("\nAfter deleting element on index 2 using delete", fruits);
console.log(
  "As we can see it creates a undefined space which is not recommended."
);
console.log("Instead use pop() and shift for deleting purpose");

const extraFruitsOne = ["JackFruit", "WaterMellon"],
  extraFruitsTwo = ["JackMellon", "WaterFruit"],
  extraFruitsThree = ["TestingOne", "TestingTwo"];
const myBasket = fruits.concat(
  extraFruitsOne,
  extraFruitsTwo,
  extraFruitsThree
);
console.log("\nMy basket contains:", myBasket);

fruits.splice(2, 0, "Lemon", "Kiwi");
console.log("\nArray after adding 'Lemon' and 'Kiwi':", fruits);
//First index defines where the Products should be put and the number of Products to remove.

fruits.splice(2, 2, "Replace1", "Replace2");
console.log("\nArray after replacing elements:", fruits);

//Delete elements from index 2 to 4
fruits.splice(2, 3);
console.log("\nArray after deleting elements from index 2 to 4:", fruits);


