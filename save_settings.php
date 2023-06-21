<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $notification = isset($_POST["notification"]) ? 1 : 0;

    // Perform any necessary validation or sanitization on the input data

    // Save the settings to a file or database
    // Here, we'll simply display the saved settings for demonstration purposes
    echo "<h2>Saved Settings:</h2>";
    echo "Email Address: " . $email . "<br>";
    echo "Receive Email Notifications: " . ($notification ? "Yes" : "No") . "<br>";
}
?>
