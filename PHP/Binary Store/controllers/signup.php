<?php

$heading = "Sign Up";
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: /");
    exit();
}

require "views/signup.view.php";