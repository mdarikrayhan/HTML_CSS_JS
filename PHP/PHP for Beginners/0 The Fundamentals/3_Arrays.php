<?php
$books = [
    "Do Androids Dream of Electric Sheep?",
    "The Langoliers",
    "Project Hail Mary"
];
$books[] = "The Hitchhiker's Guide to the Galaxy"; // Add a new book to the array
$books[1] = "The Stand"; // Update the second book in the array
foreach ($books as $index => $book) {
    echo "Book " . ($index + 1) . ": " . $book . "\n";
}
?>