<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account View</title>

    <link rel="stylesheet" href="css/updateAccount.css">
    <link rel="stylesheet" href="css/adminStyle.css">
</head>
<body>
    <?php

    session_start(); // Start the session
    include './models/model_admin.php'; // Include the model file

    ?>

    <div>
        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?>

            <div class="update-account-container">
                <div class="admin-header">
                    <div class="homepageButton-customerSearch">
                        <div class="homepageButton">
                            <a href="homeView.php">Homepage</a>
                        </div>
                        <div class="homepageButton">
                            <a href="adminView.php">Admin Page</a>
                        </div>
                    </div>

                    <div class="logoutButton-updateAccountButton">
                        <div class="logoutButton">
                            <a href="loginView.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>
    
</body>
</html>