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

function filter(array $items, callable $callback)
{
    $filteredItems = [];
    foreach ($items as $item) {
        if ($callback($item)) {
            $filteredItems[] = $item;
        }
    }
    return $filteredItems;
}

$filteredBooks = filter($books, function ($book) {
    return $book['releaseYear'] >= 2000;
});

foreach ($filteredBooks as $book) {
    echo "Name: " . $book['name'] . "\n";
    echo "Author: " . $book['author'] . "\n";
    echo "Purchase URL: " . $book['purchaseUrl'] . "\n\n";
}

?>