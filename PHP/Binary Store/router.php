<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/index.php',
    '/admin/category' => 'controllers/admin/category.php',
    '/admin/product' => 'controllers/admin/product.php',
    
    '/category' => 'controllers/category.php',
    '/product' => 'controllers/product.php',
    '/product/single' => 'controllers/product.php',
    '/product/category' => 'controllers/product.php',
    
    '/user' => 'controllers/user.php',
    '/signin' => 'controllers/user.php',
    '/signup' => 'controllers/user.php',
    '/logout' => 'controllers/user.php',
    '/profile' => 'controllers/user.php',


    
];
function routeToController($uri, $routes)
{
    if (isset($routes[$uri])) {
        require $routes[$uri];
        return;
    }
    //var_dump($uri);
    //remove the last part of the uri
    $uriParts = explode('/', $uri);
    if (count($uriParts) > 1) {
        $lastPart = array_pop($uriParts);
        $uri = implode('/', $uriParts);
        if (isset($routes[$uri])) {
            require $routes[$uri];
            return;
        }
    }
    var_dump($uri);

}

function abort($code = 404)
{
    http_response_code($code);

    require "views/{$code}.php";

    die();
}

routeToController($uri, $routes);