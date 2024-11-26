<?php
session_start();

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
    $password_input = $_POST['password'];

    // Prepare an SQL statement
    $stmt = $conn->prepare("SELECT client_id, password FROM Clients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if a client with that email exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($client_id, $password_hashed);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password_input, $password_hashed)) {
            // Set session variables
            $_SESSION['client_id'] = $client_id;
            $_SESSION['email'] = $email;

            // Redirect to client dashboard or homepage
            header('Location: customerDashboard.html');
            exit();
        } else {
            // Invalid password
            $error = "Invalid email or password.";
            header("Location: signIn.html?error=" . urlencode($error));
            exit();
        }
    } else {
        // Email not found
        $error = "Invalid email or password.";
        header("Location: signIn.html?error=" . urlencode($error));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>