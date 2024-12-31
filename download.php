<?php
// Log download attempt
function logDownloadAttempt($message) {
    $logfile = 'storage/download_log.txt';  // Store log inside the storage folder
    $date = date('Y-m-d H:i:s');
    $logMessage = "$date - $message\n";
    file_put_contents($logfile, $logMessage, FILE_APPEND);
}

// Path to the movie file inside the 'storage/movie' folder
$file = '/home/your_divyanshu_007/Pushpa2/Pushpa2-Page/storage/movie/poster.jpeg';  // Adjust file extension to match your actual file

// Check if the file exists
if (!file_exists($file)) {
    logDownloadAttempt("Attempt to download non-existent file: $file");
    die('Error: The file does not exist.');
}

// Check user agent (optional - adds extra security)
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($userAgent, 'Mozilla') === false) {
    logDownloadAttempt("Attempt to download with invalid user agent: $userAgent");
    die('Error: Invalid user agent.');
}

// Additional security checks can go here (e.g., IP filtering, CAPTCHA)

// Log the successful download attempt
logDownloadAttempt("User started download for file: $file");

// Send headers to prompt the download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));

// Clean output buffer and begin file download
ob_clean();
flush();
readfile($file);

// Log the completion of the download
logDownloadAttempt("Download completed for file: $file");

exit;
?>
