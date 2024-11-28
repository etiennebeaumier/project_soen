<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="../../styles/accountPage.css"> <!-- Link to the CSS file for styling -->
</head>
<body>
    <header>
         <a href = "../landingPage.html" id = "logo"><h1>Ctrl + F</h1></a>
        <div class="search-bar">
            <input type="text" placeholder="Search for services">
        </div>
        <div class="shopping-cart">
            <span class="cart-icon">🛒</span>
            <span class="cart-count">0</span>
        </div>
    </header>

    <main>
        <h2>My Account</h2>

        <!-- Profile Information Section -->
        <section class="account-section">
            <h3>Profile Information</h3>
            <div class="account-info">
                <p><strong>Full Name:</strong>
                <?php 
                     if (!isset($_GET["fullName"]) || empty(trim($_GET["fullName"]))) {
                    echo "Please add a full name";
                    } else {
                        echo htmlspecialchars(trim($_GET["fullName"]), ENT_QUOTES, 'UTF-8');
                    }
                ?>
                </p>

                <p><strong>Email:</strong> 
                <?php 
                     if (!isset($_GET["email"]) || empty(trim($_GET["email"]))) {
                    echo "Please add an email";
                    } else {
                        echo htmlspecialchars(trim($_GET["email"]), ENT_QUOTES, 'UTF-8');
                    }
                ?><br>
                <button class="edit-button" onclick="window.location.href='editInfo/editProfile.php'">Edit Profile</button>

            </div>
        </section>

        <!-- Password Management Section -->
        <section class="account-section">
            <h3>Password Management</h3>
            <div class="password-info">
                <p><strong>Change Password</strong></p>
                <button class="change-password-button">Change Password</button>
            </div>
        </section>

        <!-- Logout Button -->
        <button class="logout-button">Log Out</button>
    </main>

    <footer>
        <div class="container">
            
        </div>
    </footer>
    <script>
        document.getElementById("EditProfile-button").addEventListener("click", function() {
            window.location.href = "editAccountPages/changeProfileInformation.html";
        });
    </script> 
    <script>
        document.getElementById("CPB").addEventListener("click", function() {
                window.location.href = "editAccountPages/cAPassword.html";
        });
    </script>
    <script>
        document.getElementById("SaveSettings").addEventListener("click", function() {
            window.location.href = "customerDashboard.html";
        });
    </script>
</body>
</html>
