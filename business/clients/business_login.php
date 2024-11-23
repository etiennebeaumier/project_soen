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

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Retrieve and sanitize form data
    $business_name = trim($_POST['business_name']);
    $password_input = $_POST['password'];

    // Prepare an SQL statement
    $stmt = $conn->prepare("SELECT business_id, password FROM Businesses WHERE name = ?");
    $stmt->bind_param("s", $business_name);
    $stmt->execute();
    $stmt->store_result();

    // Check if a business with that name exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($business_id, $password_stored);
        $stmt->fetch();

        // Verify the password
        if ($password_input === $password_stored) {
            // Set session variables
            $_SESSION['business_id'] = $business_id;
            $_SESSION['business_name'] = $business_name;

            // Redirect to clientsview.php
            header('Location: clientsview.php');
            exit();
        } else {
            $error = "Invalid business name or password.";
            $error = urlencode($error);
            header("Location: login.html?error=$error");
            exit();
        }
    } else {
        $error = "Invalid business name or password.";
        $error = urlencode($error);
        header("Location: login.html?error=$error");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Business Login</title>
    <link rel="stylesheet" href="../styles/loginstylesB.css">
</head>
<body>
    <div class="login-container">
        <h1>Sign In as a Business</h1>
        <?php if (isset($error)) { echo '<p class="error">'.$error.'</p>'; } ?>
        <form action="business_login.php" method="POST">
            <label for="business-name">Business Name</label>
            <input type="text" id="business-name" name="business_name" required value="<?php echo isset($business_name) ? htmlspecialchars($business_name) : ''; ?>">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>
