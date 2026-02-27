<?php
/**
 * Laravel public directory loader
 * This file loads Laravel from the /public folder when Document Root cannot be changed
 */

// Define the public path
define('LARAVEL_PUBLIC_PATH', __DIR__ . '/public');

// Check if public/index.php exists
if (file_exists(LARAVEL_PUBLIC_PATH . '/index.php')) {
    // Change the working directory to public
    chdir(LARAVEL_PUBLIC_PATH);
    
    // Load Laravel
    require LARAVEL_PUBLIC_PATH . '/index.php';
} else {
    http_response_code(500);
    exit('Error: Laravel public folder not found.');
}
