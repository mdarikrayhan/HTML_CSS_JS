<?php

$heading = 'Category Management';
if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $heading = 'Create New Category';
    require "views/admin/category/create.view.php";
    return;
}

//if the method is POST, handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require "actions/admin/create.category.action.php";
    return;
}
require "views/admin/category/view.view.php";
