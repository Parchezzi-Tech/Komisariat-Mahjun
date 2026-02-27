<?php
// Script to unzip deploy.zip on the server
$zipFile = 'deploy.zip';
$extractPath = __DIR__;

if (!file_exists($zipFile)) {
    http_response_code(404);
    die("Error: deploy.zip not found.");
}

$zip = new ZipArchive;
$res = $zip->open($zipFile);

if ($res === TRUE) {
    // Extract all files
    $zip->extractTo($extractPath);
    $zip->close();
    
    // Verify .env exists after extraction
    if (file_exists($extractPath . '/.env')) {
        echo "Success: Deployed and extracted successfully. .env file found.<br>";
    } else {
        echo "Warning: Deployed but .env file not found!<br>";
    }
    
    // List some extracted files for verification
    echo "Extracted files:<br>";
    $files = scandir($extractPath);
    foreach($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "- $file<br>";
        }
    }
    
    // Clean up
    unlink($zipFile);
    
    echo "<br>Note: This script will self-destruct on next reload.";
} else {
    http_response_code(500);
    echo "Error: Could not open zip file. Error code: " . $res;
}
