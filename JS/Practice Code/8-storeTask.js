/////////////////////////////// Admin Entity ///////////////////////////////
function Admin(name) {
    this.uID = crypto.randomUUID();
    this.name = name;
}

Admin.prototype.createProduct = function (productType, productState, name, basePrice, discount, vat, extra, couponCode, couponDiscount) {
    if (productType === "phone") {
        return new Phone(productState, name, basePrice, discount, vat, extra, couponCode, couponDiscount);
    } else if (productType === "book") {
        return new Book(productState, name, basePrice, discount, vat, extra, couponCode, couponDiscount);
    }
    return null;
};

Admin.prototype.createCustomer = function (name, cash) {
    return new Customer(name, cash);
};

Admin.prototype.createOrder = function (customer, product, couponCode) {
    return customer.orderProduct(product, couponCode);
}

Admin.prototype.chargeCustomer = function (customer, order) {
    if (order === null) {
        console.log("Order failed: Product is in draft state and cannot be ordered.");
        return null;
    }
    if (!order.paymentStatus) {
        const originalCash = customer.cash;
        customer.makePayment(order);
        if (order.paymentStatus && originalCash >= order.cost) {
            this.deliverProduct(order);
        }
        else {
            order.deliveryStatus = -1;
        }
    } else {
        console.log("Order already paid.");
    }
};


Admin.prototype.deliverProduct = function (order) {
    if (order === null) {
        console.log("Order failed: Product is in draft state and cannot be ordered.");
        return null;
    }
    if (!order.paymentStatus) {
        console.log("Cannot deliver unpaid order.");
        return;
    }
    if (!order.deliveryStatus) {
        order.deliveryStatus = true;
        console.log("Order delivered:", order.uID);
    } else {
        console.log("Order already delivered:", order.uID);
    }
};

////////////////////////////// Product Entity //////////////////////////////
function Product(uID, productState, name, basePrice, discount, vat, couponCode = "none", couponDiscount = 0) {
    this.uID = crypto.randomUUID();
    this.productState = productState; // true = Published, false = Draft
    this.name = name;
    this.basePrice = basePrice;
    this.discount = discount;
    this.vat = vat;
    this.couponCode = couponCode;
    this.couponDiscount = couponDiscount;
}

Product.prototype.getFinalPrice = function (userCouponCode) {
    if (!this.productState) {
        return -1; // sentinel value indicating product is not orderable
    }
    let appliedDiscount = this.discount;
    if (this.couponCode === userCouponCode && userCouponCode != "none") {
        appliedDiscount += this.couponDiscount;
    }
    const discountedPrice = this.basePrice * (1 - (appliedDiscount / 100));
    const finalPrice = discountedPrice * (1 + (this.vat / 100));
    return finalPrice;
};

function Phone(productState, name, basePrice, discount, vat, brand, couponCode, couponDiscount) {
    let uID = crypto.randomUUID();
    Product.call(this, uID, productState, name, basePrice, discount, vat, couponCode, couponDiscount);
    this.brand = brand;
}
Phone.prototype = Object.create(Product.prototype);
Phone.prototype.constructor = Phone;

function Book(productState, name, basePrice, discount, vat, author, couponCode, couponDiscount) {
    let uID = crypto.randomUUID();
    Product.call(this, uID, productState, name, basePrice, discount, vat, couponCode, couponDiscount);
    this.author = author;
}
Book.prototype = Object.create(Product.prototype);
Book.prototype.constructor = Book;

////////////////////////////// Order Entity //////////////////////////////
function Order(productName, cost, deliveryStatus, paymentStatus) {
    this.uID = crypto.randomUUID();
    this.productName = productName;
    this.cost = cost;
    this.deliveryStatus = deliveryStatus; // false = in progress, true = delivered
    this.paymentStatus = paymentStatus;   // false = unpaid, true = paid
}

////////////////////////////// Customer Entity //////////////////////////////
function Customer(name, cash) {
    this.uID = crypto.randomUUID();
    this.name = name;
    this.cash = cash;
    this.orders = [];
}

Customer.prototype.orderProduct = function (product, userCouponCode) {
    const price = product.getFinalPrice(userCouponCode);
    if (product.productState === false) {
        console.log("Order failed: Product is in draft state and cannot be ordered.");
        return null;
    }
    const order = new Order(product.name, price, 0, false);
    this.orders.push(order);
    console.log("Order placed for", product.name, "with final price:", price.toFixed(2));
    return order;
};

Customer.prototype.makePayment = function (order) {
    if (order.paymentStatus) {
        console.log("Order already paid.");
        return;
    }
    if (this.cash >= order.cost) {
        this.cash -= order.cost;
        order.paymentStatus = true;
        console.log("Payment successful for order:", order.uID);
    } else {
        console.log("Insufficient funds for order:", order.uID);
    }
};

////////////////////////////// Test Script //////////////////////////////
const admin = new Admin("Tanmay");
console.log(admin.name, admin.uID);
const customer = admin.createCustomer("Md. Arik Rayhan", 23980);

const phone = admin.createProduct("phone", true, "Camon 40", 23999, 5, 0, "Tecno", "Arik", 5);
const book = admin.createProduct("book", false, "JavaScript: The Good Parts", 5900, 50, 0, "Douglas Crockford");

const phoneOrder = customer.orderProduct(phone, "Arik");
//const bookOrder = customer.orderProduct(book);
const bookOrder = admin.createOrder(customer, book);
console.log(phone);
console.log(book);
customer.makePayment(phoneOrder)
admin.chargeCustomer(customer, bookOrder);

admin.deliverProduct(phoneOrder);
admin.deliverProduct(bookOrder);

console.log("Remaining cash:", customer.cash.toFixed(2));
console.log("Orders:", customer.orders.map(i => ({
    id: i.uID,
    name: i.productName,
    paid: i.paymentStatus,
    delivered: i.deliveryStatus
})));
