function Furniture(manufacturer, createDate, materials, price) {
  this.manufacturer = manufacturer;
  this.createDate = createDate;
  this.materials = materials;
  this.price = price;
}

//Prototype functions for inheritance purpose
Furniture.prototype.setCreateDate = function (createDate) {
  if (!(createDate instanceof Date && !isNaN(createDate))) {
    this.createDate = "1970-01-01";
    return;
  }
  this.createDate = createDate;
};
Furniture.prototype.setMaterials = function (materials) {
  this.materials = materials;
};
Furniture.prototype.setPrice = function (price) {
  this.price = price;
};
Furniture.prototype.setManufacturer = function (manufacturer) {
  if (typeof manufacturer != "string") {
    this.manufacturer = "";
    return;
  }
  this.manufacturer = manufacturer;
};

function Chair(seatSize, rotatable, tiltable, armrest, liftable) {
  this.seatSize = seatSize;
  this.rotatable = rotatable;
  this.tiltable = tiltable;
  this.armrest = armrest;
  this.liftable = liftable;
}
Chair.prototype = Furniture.prototype;
const chair = new Chair("4", true, true, true, true);
chair.setManufacturer("regal");
chair.setPrice(5839);
chair.setCreateDate(new Date("2022-03-25"));
chair.setMaterials(["Wood", "Iron", "Plastic"]);
console.log(chair);
console.log("Is chair instance of Chair:", chair instanceof Chair);
console.log("Is chair instance of Furniture:", chair instanceof Furniture);

function Table(shape, height, width, length) {
  this.shape = shape;
  this.height = height;
  this.width = width;
  this.length = length;
}
Table.prototype = Furniture.prototype;
const table = new Table("rectangle", 1.5, 2, 3);
table.setManufacturer("bengal");
table.setPrice(15839);
table.setCreateDate(new Date("2022-03-25"));
table.setMaterials(["Wood", "Iron", "Plastic"]);
console.log(table);
console.log("Is table instance of Table:", table instanceof Table);
console.log("Is table instance of Furniture:", table instanceof Furniture);

console.log("Is table instance of chair",table instanceof Chair);

