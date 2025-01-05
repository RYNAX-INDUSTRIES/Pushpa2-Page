<?php
// Path to the file
$file = 'storage/movie/poster.jpeg'; // Adjust the path as per your structure

// Check if the file exists
if (!file_exists($file)) {
    die('Error: The file does not exist.');
}

// Send headers to initiate the download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));

// Read and output the file
readfile($file);
exit;
?>
