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
    $zip->extractTo($extractPath);
    $zip->close();
    
    // Clean up
    unlink($zipFile);
    unlink(__FILE__); // Self destruct
    
    echo "Success: Deployed and extracted successfully.";
} else {
    http_response_code(500);
    echo "Error: Could not open zip file.";
}
