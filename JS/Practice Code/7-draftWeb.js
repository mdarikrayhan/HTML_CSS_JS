const persons = [
  { name: "John Doe" },
  { name: "Jane Doe" },
  { name: "James Doe" },
];
persons.indexOF((p) => p.name === "John Doe");

persons.splice(persons.indexOf(persons.find((p) => p.name == "Jane Doe")), 1, {
  name: "Arik Rayhan",
});

persons.splice(
  persons.indexOf(persons.filter((p) => p.name == "Jane Doe")[0]),
  1,
  { name: "Arik Rahman" }
);

persons.splice(
  persons.indexOf(persons.filter((p) => p.name == "John Doe")[0]),
  1,
  { name: "Arik Rahman" }
);

true.toString();
"foo".split("").reverse().join("");
"foo".split(",");

const isAbsent = new Boolean();

isAbsent;

const isPresent = true;

isPresent;

isAbsent.toString();

isAbsent.valueOf();

const salary = new Number(123);
salary.toString();
salary;
salary.valueOf();
isAbsent;
isAbsent.valueOf().toString();