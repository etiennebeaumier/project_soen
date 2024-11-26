<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password_db = "";  // Your MySQL password
    $dbname = "soen287_project"; // Your database name

    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Retrieve and sanitize form data
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $password_input = $_POST['password'];

    // Hash the password for security
    $password_hashed = password_hash($password_input, PASSWORD_DEFAULT);

    // Prepare an SQL statement to insert the new client
    $stmt = $conn->prepare("INSERT INTO Clients (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password_hashed);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page or dashboard
        header("Location: login.html");
        exit();
    } else {
        // Handle errors (e.g., email already exists)
        $error = "Registration failed: " . $stmt->error;
        header("Location: createAccountPage.html?error=" . urlencode($error));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>