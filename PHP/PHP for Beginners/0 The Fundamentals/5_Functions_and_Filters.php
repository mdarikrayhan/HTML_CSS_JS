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
function filterByAuthor($books, $author)
{
    $filteredBooks = [];
    foreach ($books as $book) {
        if ($book['author'] === $author) {
            $filteredBooks[] = $book;
        }
    }
    return $filteredBooks;
}
$andyBooks = filterByAuthor($books, 'Andy Weir');
$philipBooks = filterByAuthor($books, 'Philip K. Dick');

print_r($andyBooks);
print_r($philipBooks);
?>