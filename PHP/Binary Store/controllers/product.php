<?php

$heading = 'Products';
if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
    require "views/single.product.view.php";
    
    return;
}

require "views/product.view.php";