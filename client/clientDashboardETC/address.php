<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Addresses</title>
    <link rel="stylesheet" href="../../styles/address.css"> <!-- Link to the CSS file -->
</head>
<body>
    <header>
        <h1>Our Logo</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search for services">
        </div>
        <div class="shopping-cart">
            <span class="cart-icon">🛒</span>
            <span class="cart-count">0</span>
        </div>
    </header>

    <main>

        <section class="address-list">
            <!-- Example address 1 -->
            <div class="address-item">
                <h3>Current Address</h3>
                <p><?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'No name provided'; ?></p> 
                <p><?php echo isset($_GET['postalCode']) ? htmlspecialchars($_GET['postalCode']) : 'No name provided'; ?></p>
                <p><?php echo isset($_GET['streetNumber']) ? htmlspecialchars($_GET['streetNumber']) : 'No name provided'; ?></p>
                
                <div class="address-actions">
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>
                </div>
            </div>

        
            <!-- Add New Address Button -->
            <button class="add-address-button" onclick="window.location.href='addAddress.html'">Add New Address</button>
        </section>
    </main>

    <footer>
        <div class="container">
            <!-- Footer content from the previous layout -->
        </div>
    </footer>
</body>
</html>
