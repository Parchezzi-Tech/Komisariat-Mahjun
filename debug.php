<?php
/**
 * Debug script to check Laravel errors
 */

echo "<h2>Laravel Debug Information</h2>";

// Check if Laravel files exist
echo "<h3>1. File Structure Check:</h3>";
echo "- public/index.php: " . (file_exists(__DIR__ . '/public/index.php') ? "✓ EXISTS" : "✗ MISSING") . "<br>";
echo "- bootstrap/app.php: " . (file_exists(__DIR__ . '/bootstrap/app.php') ? "✓ EXISTS" : "✗ MISSING") . "<br>";
echo "- .env: " . (file_exists(__DIR__ . '/.env') ? "✓ EXISTS" : "✗ MISSING") . "<br>";
echo "- vendor/autoload.php: " . (file_exists(__DIR__ . '/vendor/autoload.php') ? "✓ EXISTS" : "✗ MISSING") . "<br>";

// Check permissions
echo "<h3>2. Folder Permissions:</h3>";
$storage = __DIR__ . '/storage';
$bootstrap = __DIR__ . '/bootstrap/cache';

if (is_dir($storage)) {
    echo "- storage: " . substr(sprintf('%o', fileperms($storage)), -4) . " (should be 0755 or 0777)<br>";
    echo "  - writable: " . (is_writable($storage) ? "✓ YES" : "✗ NO") . "<br>";
}

if (is_dir($bootstrap)) {
    echo "- bootstrap/cache: " . substr(sprintf('%o', fileperms($bootstrap)), -4) . " (should be 0755 or 0777)<br>";
    echo "  - writable: " . (is_writable($bootstrap) ? "✓ YES" : "✗ NO") . "<br>";
}

// Check .env content
echo "<h3>3. Environment Variables:</h3>";
if (file_exists(__DIR__ . '/.env')) {
    $env = file_get_contents(__DIR__ . '/.env');
    $lines = explode("\n", $env);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line && !str_starts_with($line, '#')) {
            // Hide sensitive values
            if (preg_match('/^([^=]+)=(.*)$/', $line, $matches)) {
                $key = $matches[1];
                $value = $matches[2];
                if (in_array($key, ['DB_PASSWORD', 'APP_KEY'])) {
                    $value = str_repeat('*', min(strlen($value), 20));
                }
                echo "- $key = $value<br>";
            }
        }
    }
}

// Try to load Laravel
echo "<h3>4. Laravel Bootstrap Test:</h3>";
try {
    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require __DIR__ . '/vendor/autoload.php';
        echo "✓ Composer autoload loaded<br>";
        
        if (file_exists(__DIR__ . '/bootstrap/app.php')) {
            $app = require_once __DIR__ . '/bootstrap/app.php';
            echo "✓ Laravel app loaded<br>";
        }
    }
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "<br>";
    echo "Stack trace:<br><pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<h3>5. PHP Information:</h3>";
echo "- PHP Version: " . PHP_VERSION . "<br>";
echo "- Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "<br>";
echo "- Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "<br>";
echo "- Current Directory: " . __DIR__ . "<br>";

echo "<hr><p><strong>Instructions:</strong> If you see any errors above, fix them. If everything looks OK, the issue might be in Laravel error logs at storage/logs/laravel.log</p>";
