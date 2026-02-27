<?php
/**
 * Fresh Deployment Script
 * 1. Delete all old files except deploy.zip and this script
 * 2. Extract deploy.zip
 * 3. Clean up
 */

set_time_limit(300); // 5 minutes max
ini_set('display_errors', 1);
error_reporting(E_ALL);

$zipFile = 'deploy.zip';
$extractPath = __DIR__;

echo "=== Fresh Deployment Started ===<br><br>";

// Step 1: Check if deploy.zip exists
if (!file_exists($zipFile)) {
    http_response_code(404);
    die("ERROR: deploy.zip not found in: " . $extractPath);
}

echo "✓ deploy.zip found<br>";

// Step 2: Delete all files and folders except deploy.zip and this script
echo "<br>Step 1: Cleaning old files...<br>";
$protected = ['deploy.zip', 'unzip_deploy.php'];
$deleted = 0;

$items = scandir($extractPath);
foreach ($items as $item) {
    if ($item === '.' || $item === '..') continue;
    if (in_array($item, $protected)) continue;
    
    $fullPath = $extractPath . '/' . $item;
    
    if (is_dir($fullPath)) {
        // Recursive delete directory
        deleteDirectory($fullPath);
        echo "  - Deleted directory: $item<br>";
    } else {
        unlink($fullPath);
        echo "  - Deleted file: $item<br>";
    }
    $deleted++;
}

echo "✓ Cleaned $deleted items<br>";

// Step 3: Extract deploy.zip
echo "<br>Step 2: Extracting deploy.zip...<br>";
$zip = new ZipArchive;
$res = $zip->open($zipFile);

if ($res === TRUE) {
    $zip->extractTo($extractPath);
    $numFiles = $zip->numFiles;
    $zip->close();
    
    echo "✓ Extracted $numFiles files<br>";
} else {
    http_response_code(500);
    die("ERROR: Could not open zip file. Error code: " . $res);
}

// Step 4: Verify critical files
echo "<br>Step 3: Verifying deployment...<br>";
$criticalFiles = ['.env', 'vendor/autoload.php', 'public/index.php', 'artisan'];
$allGood = true;

foreach ($criticalFiles as $file) {
    $exists = file_exists($extractPath . '/' . $file);
    echo ($exists ? "✓" : "✗") . " $file<br>";
    if (!$exists) $allGood = false;
}

// Step 5: Set permissions
echo "<br>Step 4: Setting permissions...<br>";
if (is_dir($extractPath . '/storage')) {
    chmod($extractPath . '/storage', 0755);
    chmodRecursive($extractPath . '/storage', 0755);
    echo "✓ storage/ permissions set<br>";
}

if (is_dir($extractPath . '/bootstrap/cache')) {
    chmod($extractPath . '/bootstrap/cache', 0755);
    chmodRecursive($extractPath . '/bootstrap/cache', 0755);
    echo "✓ bootstrap/cache/ permissions set<br>";
}

// Step 6: Clean up
echo "<br>Step 5: Cleaning up...<br>";
if (file_exists($zipFile)) {
    unlink($zipFile);
    echo "✓ Removed deploy.zip<br>";
}

if ($allGood) {
    echo "<br>=== ✓ DEPLOYMENT SUCCESSFUL ===<br>";
    echo "<br><a href='/'>Visit Website</a><br>";
    echo "<br><small>This script will self-destruct on next access.</small>";
    
    // Self destruct on next page load (mark for deletion)
    file_put_contents($extractPath . '/.unzip_done', 'done');
} else {
    echo "<br>=== ✗ DEPLOYMENT COMPLETED WITH WARNINGS ===<br>";
    echo "Some critical files are missing. Check the list above.<br>";
}

// Check if we should self-destruct
if (file_exists($extractPath . '/.unzip_done') && !isset($_GET['keep'])) {
    unlink(__FILE__);
    unlink($extractPath . '/.unzip_done');
    die("Script self-destructed. Deployment complete.");
}

// Helper function to recursively delete directory
function deleteDirectory($dir) {
    if (!is_dir($dir)) return false;
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . '/' . $item;
        is_dir($path) ? deleteDirectory($path) : unlink($path);
    }
    return rmdir($dir);
}

// Helper function to recursively chmod
function chmodRecursive($path, $mode) {
    if (!is_dir($path)) {
        return chmod($path, $mode);
    }
    $items = scandir($path);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $fullPath = $path . '/' . $item;
        if (is_dir($fullPath)) {
            chmod($fullPath, $mode);
            chmodRecursive($fullPath, $mode);
        } else {
            chmod($fullPath, $mode);
        }
    }
    return chmod($path, $mode);
}
