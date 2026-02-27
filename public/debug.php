<?php
/**
 * Debug script - placed in public folder
 */

echo "<h2>Laravel Debug - Public Folder</h2>";

// Go up one directory to project root
$root = dirname(__DIR__);

echo "<h3>1. File Structure Check:</h3>";
echo "- Root: $root<br>";
echo "- bootstrap/app.php: " . (file_exists($root . '/bootstrap/app.php') ? "✓ EXISTS" : "✗ MISSING") . "<br>";
echo "- .env: " . (file_exists($root . '/.env') ? "✓ EXISTS" : "✗ MISSING") . "<br>";
echo "- vendor/autoload.php: " . (file_exists($root . '/vendor/autoload.php') ? "✓ EXISTS" : "✗ MISSING") . "<br>";

// Check permissions
echo "<h3>2. Folder Permissions:</h3>";
$storage = $root . '/storage';
$bootstrap = $root . '/bootstrap/cache';

if (is_dir($storage)) {
    echo "- storage: " . substr(sprintf('%o', fileperms($storage)), -4) . "<br>";
    echo "  - writable: " . (is_writable($storage) ? "✓ YES" : "✗ NO - FIX THIS!") . "<br>";
} else {
    echo "- storage: ✗ NOT FOUND<br>";
}

if (is_dir($bootstrap)) {
    echo "- bootstrap/cache: " . substr(sprintf('%o', fileperms($bootstrap)), -4) . "<br>";
    echo "  - writable: " . (is_writable($bootstrap) ? "✓ YES" : "✗ NO - FIX THIS!") . "<br>";
} else {
    echo "- bootstrap/cache: ✗ NOT FOUND<br>";
}

// Check recent Laravel logs
echo "<h3>3. Recent Laravel Errors:</h3>";
$logFile = $root . '/storage/logs/laravel.log';
if (file_exists($logFile)) {
    $logs = file_get_contents($logFile);
    $lines = explode("\n", $logs);
    $recentLines = array_slice($lines, -50); // Last 50 lines
    echo "<pre style='background:#f5f5f5; padding:10px; max-height:300px; overflow:auto; font-size:11px;'>";
    echo htmlspecialchars(implode("\n", $recentLines));
    echo "</pre>";
} else {
    echo "No log file found yet.<br>";
}

// Try to load Laravel
echo "<h3>4. Laravel Bootstrap Test:</h3>";
try {
    if (file_exists($root . '/vendor/autoload.php')) {
        require $root . '/vendor/autoload.php';
        echo "✓ Composer autoload loaded<br>";
        
        if (file_exists($root . '/bootstrap/app.php')) {
            $app = require_once $root . '/bootstrap/app.php';
            echo "✓ Laravel app loaded<br>";
            echo "✓ Laravel is working! The issue might be with routes or controllers.<br>";
        }
    } else {
        echo "✗ vendor/autoload.php not found!<br>";
    }
} catch (Exception $e) {
    echo "✗ ERROR: " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<pre style='background:#fee; padding:10px; font-size:11px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
} catch (Error $e) {
    echo "✗ FATAL ERROR: " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<pre style='background:#fee; padding:10px; font-size:11px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "<h3>5. PHP & Server Info:</h3>";
echo "- PHP Version: " . PHP_VERSION . "<br>";
echo "- Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "<br>";
echo "- Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "<br>";
echo "- Script Path: " . __DIR__ . "<br>";
echo "- Project Root: " . $root . "<br>";
