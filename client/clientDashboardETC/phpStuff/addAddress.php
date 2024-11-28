<?php

require_once 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name     = trim($_POST['full_name']);
    $province      = trim($_POST['province']);
    $city          = trim($_POST['city']);
    $street_number = trim($_POST['street_number']);
    $street_name   = trim($_POST['street_name']);
    $postal_code   = trim($_POST['postal_code']);
    $phone_number  = trim($_POST['phone_number']);
    $is_default    = isset($_POST['is_default']) ? 1 : 0;

    // Validate fields
    if (empty($full_name) || empty($province) || empty($city) || empty($street_number) || empty($street_name) || empty($postal_code) || empty($phone_number)) {
        echo "All fields are required. Please go back and fill in all fields.";
        exit;
    }

    // Update previous default address if this one is set as default
    if ($is_default) {
        $unset_default_sql = "UPDATE addresses SET is_default = 0 WHERE is_default = 1";
        if (!$conn->query($unset_default_sql)) {
            echo "Error unsetting previous default address: " . $conn->error;
            exit;
        }
    }

    // Insert new address into the database
    $stmt = $conn->prepare("INSERT INTO addresses (full_name, province, city, street_number, street_name, postal_code, phone_number, is_default) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sssssssi", $full_name, $province, $city, $street_number, $street_name, $postal_code, $phone_number, $is_default);

    if ($stmt->execute()) {
        // Redirect to addresss.php with the submitted data
        header("Location: addresss.php?full_name=" . urlencode($full_name) .
               "&province=" . urlencode($province) .
               "&city=" . urlencode($city) .
               "&street_number=" . urlencode($street_number) .
               "&street_name=" . urlencode($street_name) .
               "&postal_code=" . urlencode($postal_code) .
               "&phone_number=" . urlencode($phone_number) .
               "&is_default=" . urlencode($is_default));
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to addresss.php even if accessed without POST data
    header("Location: addresss.php");
    exit;
}
?>
