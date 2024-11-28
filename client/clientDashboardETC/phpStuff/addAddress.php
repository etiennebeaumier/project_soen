<?php
// addAddress.php

// Include the database configuration file
require_once 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $full_name     = trim($_POST['full_name']);
    $province      = trim($_POST['province']);
    $city          = trim($_POST['city']);
    $street_number = trim($_POST['street_number']);
    $street_name   = trim($_POST['street_name']);
    $postal_code   = trim($_POST['postal_code']);
    $phone_number  = trim($_POST['phone_number']);
    $is_default    = isset($_POST['is_default']) ? 1 : 0;

    // Basic validation (you can add more robust validation)
    if (empty($full_name) || empty($province) || empty($city) || empty($street_number) || empty($street_name) || empty($postal_code) || empty($phone_number)) {
        echo "All fields are required. Please go back and fill in all fields.";
        exit;
    }

    // If setting as default, unset previous default addresses
    if ($is_default) {
        $unset_default_sql = "UPDATE addresses SET is_default = 0 WHERE is_default = 1";
        if (!$conn->query($unset_default_sql)) {
            echo "Error unsetting previous default address: " . $conn->error;
            exit;
        }
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO addresses (full_name, province, city, street_number, street_name, postal_code, phone_number, is_default) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sssssssi", $full_name, $province, $city, $street_number, $street_name, $postal_code, $phone_number, $is_default);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to Manage Addresses page after successful insertion
        header("Location: manageAddresses.php?success=1");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If accessed without POST data, redirect to Add Address form
    header("Location: addAddress.html");
    exit;
}
?>
