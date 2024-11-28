<?php
// Retrieve the values from the query string
$full_name = isset($_GET['full_name']) ? htmlspecialchars($_GET['full_name'], ENT_QUOTES, 'UTF-8') : 'N/A';
$province = isset($_GET['province']) ? htmlspecialchars($_GET['province'], ENT_QUOTES, 'UTF-8') : 'N/A';
$city = isset($_GET['city']) ? htmlspecialchars($_GET['city'], ENT_QUOTES, 'UTF-8') : 'N/A';
$street_number = isset($_GET['street_number']) ? htmlspecialchars($_GET['street_number'], ENT_QUOTES, 'UTF-8') : 'N/A';
$street_name = isset($_GET['street_name']) ? htmlspecialchars($_GET['street_name'], ENT_QUOTES, 'UTF-8') : 'N/A';
$postal_code = isset($_GET['postal_code']) ? htmlspecialchars($_GET['postal_code'], ENT_QUOTES, 'UTF-8') : 'N/A';
$phone_number = isset($_GET['phone_number']) ? htmlspecialchars($_GET['phone_number'], ENT_QUOTES, 'UTF-8') : 'N/A';
$is_default = isset($_GET['is_default']) ? ($_GET['is_default'] == '1' ? 'Yes' : 'No') : 'No';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Addresses</title>
    <link rel="stylesheet" href="../../styles/address.css">
</head>
<body>
    <header>
        <a href="../landingPage.html" id="Logo"><h1>Our Logo</h1></a>
        <div class="search-bar">
            <input type="text" placeholder="Search for services">
        </div>
        <div class="shopping-cart">
            <span class="cart-icon">🛒</span>
            <span class="cart-count">0</span>
        </div>
    </header>

    <main>
        <h2>My Addresses</h2>

        <section class="address-list">
            <!-- Displaying the dynamic address details -->
            <div class="address-item">
                <h3>Home</h3>
                <p><?php echo "$street_number $street_name, $city, $province, $postal_code"; ?></p>
                <p>Phone: <?php echo $phone_number; ?></p>
                <p><strong>Default Address:</strong> <?php echo $is_default; ?></p>
                <div class="address-actions">
                <button class="edit-button" onclick="window.location.href='addAddress.html'">Add New Address</button>
                    <button class="delete-button">Delete</button>
                </div>
            </div>

            <button class="add-address-button" onclick="window.location.href='addAddress.html'">Add New Address</button>
        </section>
    </main>

    <footer>
        <div class="container">
            <!-- Footer content -->
        </div>
    </footer>
</body>
</html>

