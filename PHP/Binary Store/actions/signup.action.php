<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $division = $_POST['division'];
    $district = $_POST['district'];
    $upazila = $_POST['upazila'];
    $zipcode = $_POST['zipcode'];

    // Validate the input data
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($phone) || empty($division) || empty($district) || empty($upazila) || empty($zipcode)) {
        // Handle the error, e.g., redirect back with an error message
        header('Location: /signup?error=Please fill in all fields');
        exit();
    }

    // Create a new User instance
    $user = new User();
    // Save the user to the database
    $user->save($first_name, $last_name, $email, $password, $phone, $division, $district, $upazila, $zipcode);
    // Redirect to the login page
    header('Location: /login');
    exit();
}