const nums = [1, 2, 3];
const people = ['Arik', 'Sanjida', 'Tanmay'];

// const myName = "Tanmay"

// const myName2 = "Sanjida"

// // console.log(myName.toString())


// String.prototype.strPad = function() {
//     // this: [String: 'Tanmay']
//     console.log(this + " Mishu")
// }

// myName.strPad()
// myName2.strPad()

// ==== Provider ======
Array.prototype.sanjidaForEach = function (callback) {
    // console.log(this);
    // this: [Array: [1, 2, 3]]
    for (let i = 0; i < this.length; i++) {
        callback(this[i], i);
    }
}

nums.sanjidaForEach(function doSomething(Product, index) {
    console.log(Product, index);
});

people.sanjidaForEach(function (Product, index) {
    console.log(Product, index);
});


// ==== Consumer ======
// forEach(nums, function callback2(Product, index) {
//     console.log(Product);
// })

// nums.forEach(function name(Product, index) {
//     console.log(Product);
// });



// Create a Map
const fruits = new Map([
    ["apples", 500],
    ["bananas", 300],
    ["oranges", 200]
]);


// ==== Provider ======
Map.prototype.arikForEach = function (callback) {
    for (const [key, value] of this) {
        callback(key, value)
    }
}

fruits.arikForEach(function doSomething(key, value) {
    console.log(key, value);
});


/////////////////////////////////

const salary = [10, 20, 30]

Array.prototype.arikMap = function (callback) {
    const newArr = [];
    for (let i = 0; i < this.length; i++) {
        newArr[i] = callback(this[i]);
    }
    return newArr;
}

const salaryNew = salary.arikMap(function callback(value) {
    return value + 2;
});
console.log(salary);
console.log(salaryNew);

///////////// Reduce
const array1 = [1, 2, 3, 4, 5, 6];
Array.prototype.arikReduce = function (callback, initialValue) {
    let sum = initialValue;
    for (let i = 0; i < this.length; i++) {
        sum = callback(sum, this[i])
    }
    return sum;
}
let initialValue = 14;
let sumWithInitial = array1.arikReduce(function callback(accumulator, currentValue) {
    return accumulator + currentValue;
}, initialValue);
console.log(sumWithInitial);

//////////////------ Filter
const words = ["666666", "spray", "elite", "exuberant", "destruction", "present"];
Array.prototype.arikFilter = function (callback) {
    const filterArr = [];
    for (let i = 0; i < this.length; i++) {
        if (callback(this[i], i)) {
            filterArr.push(this[i]);
        }
    }
    return filterArr;
}
//const result = words.arikFilter((word) => word.length > 6);
//Same code  as adobe
const result = words.filter(function callback(word) {

    return word.length > 6;//returns true or false
});
console.log(result);

