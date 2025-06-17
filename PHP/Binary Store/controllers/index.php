<?php

$heading = "Home";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $streetAddress = $_POST['street-address'] ?? '';
    $division = $_POST['division'] ?? '';
    $district = $_POST['district'] ?? '';

    // Here you can add code to process the form data, like saving it to a database
    // For now, we'll just set a success message
    $message = "Form submitted successfully!";

    // DB Insert
    // Session create

    header('Location: /index.php?message=' . urlencode($message));
    exit;
}

require "views/index.view.php";