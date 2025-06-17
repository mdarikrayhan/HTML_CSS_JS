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

    //print the values for debugging
    echo "First Name: $first_name\n";
    echo "Last Name: $last_name\n";
    echo "Email: $email\n";
    echo "Password: $password\n";
    echo "Phone: $phone\n";
    echo "Division: $division\n";
    echo "District: $district\n";
    echo "Upazila: $upazila\n";
    echo "Zipcode: $zipcode\n";


    // Create a new User instance
    $user = new User($first_name, $last_name, $email, $password, $phone, $division, $district, $upazila, $zipcode);
    // Save the user to the database
    $user->save();
}