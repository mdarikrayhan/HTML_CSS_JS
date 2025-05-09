class Product {
    constructor(title, description, price) {
        this.title = title;
        this.description = description;
        this.price = price;
    }

    toHTML() {
        return `<h1>${this.title}</h1><p>${this.description}</p>`;
    }
}

class Product {
    constructor(title, description, price) {
        this.title = title;
        this.description = description;
        this.price = price;
    }

    toHTML() {
        return `<h1>${this.title}</h1><p>${this.description}</p>`;
    }

    static greet() {
        return "Hello";
    }
}

Product.greet();
'Hello'
class Product {
    constructor(title, description, price) {
        this.title = title;
        this.description = description;
        this.price = price;
    }

    static toHTML() {
        return `<h1>${this.title}</h1><p>${this.description}</p>`;
    }

    static greet() {
        return "Hello";
    }
}

Product.toHTML();
