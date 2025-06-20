<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/index.php',
    '/login' => 'controllers/login.php',
    '/signup' => 'controllers/signup.php',
    '/profile' => 'controllers/profile.php',
    '/admin/category' => 'controllers/admin/category.php',
    '/admin/product' => 'controllers/admin/product.php',
    '/category' => 'controllers/category.php',
    '/product' => 'controllers/product.php',
];

$actions = [
    '/signup' => 'actions/signup.action.php',
    '/signin' => 'actions/signin.action.php',
    '/logout' => 'actions/logout.action.php',
];

function routeToController($uri, $routes, $actions)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($actions[$uri])) {
        require $actions[$uri];
        return;
    }
    if (isset($routes[$uri])) {
        require $routes[$uri];
        return;
    }
}

function abort($code = 404)
{
    http_response_code($code);

    require "views/{$code}.php";

    die();
}

routeToController($uri, $routes, $actions);