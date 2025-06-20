<?php

$heading = 'Product Management';
if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $heading = 'Create New Product';
    require "views/admin/product/create.view.php";
    return;
}

//if the method is POST, handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require "actions/admin/create.product.action.php";
    return;
}

if (isset($_GET['action']) && $_GET['action'] === 'view') {
    require "views/admin/product/single.view.php";
    return;
}
require "views/admin/product/view.view.php";
