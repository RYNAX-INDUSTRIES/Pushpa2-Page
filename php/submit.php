<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_db"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate input
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepare and bind the SQL statement
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Your message has been sent successfully!'); window.location.href='/home/your_divyanshu_007/Pushpa2/Pushpa2-Page/index.html';</script>";
        } else {
            echo "<script>alert('Error occurred while submitting your message. Please try again later.'); window.location.href='/home/your_divyanshu_007/Pushpa2/Pushpa2-Page/contact.html';</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Please fill out all fields before submitting.'); window.history.back();</script>";
    }
}

// Close the connection
$conn->close();
?>
