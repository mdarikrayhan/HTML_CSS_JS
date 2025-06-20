<?php

$heading = "Profile";
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

require "views/profile.view.php";