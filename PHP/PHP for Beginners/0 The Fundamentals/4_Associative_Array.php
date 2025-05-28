<?php
$books = [
    [
        "name" => "Do Androids Dream of Electric Sheep?",
        "author" => "Philip K. Dick",
        "purchaseUrl" => "https://example.com/androids-dream"
    ],
    [
        "name" => "Project Hail Mary",
        "author" => "Andy Weir",
        "purchaseUrl" => "https://example.com/hail-mary"
    ]
];
foreach ($books as $book) {
    echo "Book Name: " . $book["name"] . "\n";
    echo "Author: " . $book["author"] . "\n";
    echo "Purchase URL: " . $book["purchaseUrl"] . "\n\n";
}
?>