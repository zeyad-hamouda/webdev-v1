<?php
// Get the requested URL path
$url = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/';

// Remove the base directory from the URL path
$base_dir = '/webdev1';
if (strpos($url, $base_dir) === 0) {
    $url = substr($url, strlen($base_dir));
}

// Define the routes
$routes = [
    '/' => 'home.php',
    '/login' => 'login.php',
    '/signup' => 'signup.php',
    '/home' => 'home.php',
];

// Route the request based on the URL path
if (array_key_exists($url, $routes)) {
    include $routes[$url];
} else {
    include '404.php'; // Handle 404 Not Found
}
?>
