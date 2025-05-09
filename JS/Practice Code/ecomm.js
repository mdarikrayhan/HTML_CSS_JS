const admins = [];
const customers = [];
const products = [];
const orders = [];

function Admin(email, name) {
    this.email = email;
    this.name = name;
}

function Customer(email, name, createdBy) {
    this.email = email;
    this.name = name;
    this.createdBy = createdBy;
}

Customer.prototype.register = function () {
    if (this.email.split("@").length < 2) {
        throw new Error("Not a valid email");
    }
    this.createdBy = this.email;
    customers.push(this);
}

Admin.prototype.addCustomer = function (email, name) {
    customers.push(new Customer(email, name, this.email));
}

Admin.prototype.addProduct = function (...productCollection) {
    productCollection.forEach(product => {
        if (product.title == "") {
            throw Error("Title cannot be empty");
        }

        products.push(product);
    });
}

// function createProduct(id, product) {
//     if (product instanceof Phone) {
//         return createPhone()
//     }
// }

// function createPhone(id, name, model, cost) {
//     return new Phone(id, name, model, cost)
// }

function Product(id, title, description, createdBy) {
    this.id = id;
    this.title = title;
    this.description = description;
    this.createdBy = createdBy;
    this.status = "draft";
}

// false, 0, null, undefined, "", 

Product.prototype.publish = function (admin) {
    if (!admins.find(a => a.email == admin.email)) {
        throw Error("You cannot publish this product");
    }
    this.status = "publish";
}

function Phone(id, title, description, createdBy, brand) {
    Product.call(this, id, title, description, createdBy, brand)
}

function Book(id, title, description, createdBy, author) {
    Product.call(this, id, title, description, createdBy, author)
}

Phone.prototype = Object.create(Product.prototype);
Book.prototype = Object.create(Product.prototype);
Phone.prototype.constructor = Phone;
Book.prototype.constructor = Book;

admins.push(
    new Admin("arik@wedevs.com", "Arik Rayhan"),
    new Admin("tanmay@wedevs.com", "Tanmay Mishu"),
)

const eligibleAdmin = admins.find(a => a.email == "tanmay@wedevs.com");

eligibleAdmin.addCustomer("sanjida@wedevs.com", "Sanjida Akter");

eligibleAdmin.addProduct(
    new Phone(123, "iPhone 11", "Good phone", eligibleAdmin.email, "Apple"),
    new Book(124, "JS: The Good Parts", "A good book", eligibleAdmin.email, "Douglas Crockford"),
)

// eligibleAdmin.addProduct(
//     new Book(124, "JS: The Good Parts", "A good book", eligibleAdmin.email, "Douglas Crockford"),
// )


products.find(p => p.id == 123).publish(
    // new Admin("foo@example.com", "Hacker Admin"),
    admins.find(a => a.email == "arik@wedevs.com")
);

new Customer("asfsd@gmail.com", "sdfsdf").register();


console.log(customers, products);