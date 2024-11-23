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

// Fetch business details
$stmt = $conn->prepare("SELECT name, logo_image FROM Businesses WHERE business_id = ?");
$stmt->bind_param("i", $business_id);
$stmt->execute();
$stmt->bind_result($business_name, $logo_image);
$stmt->fetch();
$stmt->close();

// Fetch services offered by the business
$services = [];
$stmt = $conn->prepare("SELECT service_name FROM Services WHERE business_id = ?");
$stmt->bind_param("i", $business_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $services[] = $row['service_name'];
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Business Information</title>
  <link rel="stylesheet" href="../../styles/boilerplateStyles.css">
  <link rel="stylesheet" href="../clients/clientsStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <!-- Top navigation with logo and logout -->
  <header>
    <div class="logo">
      <!-- Display business logo if available -->
      <?php if (!empty($logo_image)): ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($logo_image); ?>" alt="Logo">
      <?php else: ?>
        <img src="default-logo.png" alt="Default Logo">
      <?php endif; ?>
    </div>
    <h1 class="business-name"><?php echo htmlspecialchars($business_name); ?></h1>
    <div class="logout">
      <a href="logout.php">
        <i class="fas fa-power-off"></i> Log Out
      </a>
    </div>
  </header>

  <div class="main-container">
    <!-- Sidebar with categories and dropdown menus  -->
    <aside class="sidebar">
      <ul>
        <li class="">
          <a href="editClient.html">Business Info</a>
          <ul class="submenu">
            <li><a href="editClient.html">Manage Profile</a></li>
            <li class="selected"><a href="clientsview.php">Clients View</a></li>
          </ul>
        </li>
        <li>
          <a href="../services/manage-services/create-service.html">Service</a>
          <ul class="submenu">
            <li><a href="../services/manage-services/create-service.html">Manage Services</a></li>
            <li><a href="#">Purchased Service View</a></li>
          </ul>
        </li>
        <li class="Clients">
          <a href="view-client.html">Clients</a>
          <ul class="submenu">
            <li><a href="view-client.html">View Clients</a></li>
          </ul>
        </li>
        <li>
          <a href="../support/dashboard.html">Support</a>
          <ul class="submenu">
            <li><a href="../support/dashboard.html">Tickets</a></li>
          </ul>
        </li>
      </ul>
    </aside>

    <!-- Main content area -->
    <section class="content">
      <h2>Business Information</h2>
      <div class="business-info">
          <div class="business-logo">
              <!-- Display business logo if available -->
              <?php if (!empty($logo_image)): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($logo_image); ?>" alt="Business Logo">
              <?php else: ?>
                <img src="default-logo.png" alt="Business Logo">
              <?php endif; ?>
          </div>
          <div class="business-details">
              <h3>Business Name: <span><?php echo htmlspecialchars($business_name); ?></span></h3>
              <p><strong>Description:</strong> N/A</p>
              <h4>Services Offered:</h4>
              <ul>
                  <?php if (!empty($services)): ?>
                      <?php foreach ($services as $service): ?>
                          <li><?php echo htmlspecialchars($service); ?></li>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <li>No services offered yet.</li>
                  <?php endif; ?>
              </ul>
          </div>
      </div>
    </section>
  </div>

  <!-- Include the footer -->
  <footer>
    <div class="container">
        <div class="footer-columns">
            <!-- Footer content remains the same -->
            <!-- ... -->
        </div>
        <p class="copyright">&copy; 2023 Your Company Name. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
