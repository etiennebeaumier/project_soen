<?php
session_start();

// Check if the business is logged in
if (!isset($_SESSION['business_id'])) {
    // Not logged in, redirect to login page
    header('Location: login.html');
    exit();
}

// Retrieve business ID from session
$business_id = $_SESSION['business_id'];

// Database connection parameters
$servername = "localhost";
$username = "root"; // Your MySQL username
$password_db = "";  // Your MySQL password
$dbname = "soen287_project"; // Your database name

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check for a connection error and handle it
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nam = htmlspecialchars($_POST['business-name']);
  $descriptio = htmlspecialchars($_POST['business-description']);
  $logo_imag  = mysqli_real_escape_string($conn, $_FILES['business-logo']);
  $query = mysqli_query($conn,"UPDATE Businesses SET name = $nam WHERE id=$business_id");
  $query1 = mysqli_query($conn,"UPDATE Businesses SET description = descriptio WHERE id=$business_id");
  $query2 = mysqli_query($conn,"UPDATE Businesses SET logo_image = $logo_imag WHERE id=$business_id");
  $stmt = mysqli_prepare($conn, $query);
  $stmt->bind_param("s", $nam);
  mysqli_stmt_execute($stmt);
  $stmt->close();
  $stmt = mysqli_prepare($conn, $query1);
  $stmt->bind_param("s", $descriptio);
  mysqli_stmt_execute($stmt);
  $stmt->close();
  $stmt = mysqli_prepare($conn, $query2);
  $stmt->bind_param("s", $logo_imag);
  mysqli_stmt_execute($stmt);
  $stmt->close();

}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navigation Page</title>
  <link rel="stylesheet" href="../../styles/boilerplateStyles.css">
  <link rel="stylesheet" href="../clients/editbusiness.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  
</head>
<body>
  <!-- Top navigation with logo and logout -->
  <header>
    <div class="logo">
      <a href = "../../client/landingPage.html"><img src="../../logo.png" alt="Logo"></a>
    </div>
    <h1 class="business-name">[Business Name]</h1>
    <div class="logout">
      <a href="../../client/signIn.html">
        <i class="fas fa-power-off"></i> Log Out
      </a>
    </div>
  </header>

  <div class="main-container">
    <!-- Sidebar with categories and dropdown menus -->
    <aside class="sidebar">
            <ul>
                <li>
                    <p>Business Info</p>
                    <ul class="submenu">
                        <li><a href="../profile/edit-appearance.html">Manage Profile</a></li>
                        <li><a href="../profile/edit-business-info.html">Edit</a></li>
                    </ul>
                </li>
                <li>
                    <p>Service</p>
                    <ul class="submenu">
                        <li><a href="../services/manage-services/create-service.html">Create service</a></li>
                        <li><a href="../services/manage-services/view.html">Manage services</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../clients/view-client.html">Clients</a>
                    <ul class="submenu">
                        <li><a href="../clients/clientsview.html">Clients veiw</a></li>
                        <li><a href="../clients/editClient.html">edit clients </a></li>
                    </ul>
                </li>
                <li>
                    <a href="../support/supportdashboard.html">Support</a>
                    <ul class="submenu">
                        <li><a href="../support/view-tickets.html">Tickets</a></li>
                    </ul>
                </li>
    </aside>

    <!-- Main content area -->
    <section class="content">
      <h2>Edit Business Information</h2>
      <form action="update-business-info.html" method="post" enctype="multipart/form-data" class="edit-business-form">
          <div class="form-group">
              <label for="business-name">Business Name:</label>
              <input type="text" id="business-name" name="business-name" required>
          </div>
          <div class="form-group">
              <label for="business-description">Business Description:</label>
              <textarea id="business-description" name="business-description" rows="4" required></textarea>
          </div>
          <div class="form-group">
              <label for="business-logo">Business Logo:</label>
              <input type="file" id="business-logo" name="business-logo" accept="image/*" required>
          </div>
          <div class="form-group">
              <button type="submit">Save Changes</button>
          </div>
      </form>
  </section>
  </div>
</body>

<footer>
    <div class="container">
        <div class="footer-columns">
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p>Email: info@yourcompany.com</p>
                <p>Phone: +1 (123) 456-7890</p>
                <p>Address: 123 Main St, City, Country</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <p><li><a href="#">FAQ</a></li></p>
                    <p><li><a href="#">Privacy Policy</a></li></p>
                    <p><li><a href="#">Terms of Use</a></li></p>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Follow Us</h3>
                <ul class="social-media">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <p class="copyright">&copy; 2024 Your Company Name. All rights reserved.</p>
    </div>
  </footer>
</html>
