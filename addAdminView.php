<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin Account</title>
    <link rel="stylesheet" href="css/updateAccount.css">
    <link rel="stylesheet" href="css/adminStyle.css">
</head>
<body>
    
    <?php
    
    session_start(); // Start the session
    include './models/model_admin.php'; // Include the model file

    $error = ""; // Initialize error message variable
    $username = ""; // Initialize username variable
    $password = ""; // Initialize password variable
    $confirmPassword = ""; // Initialize confirm password variable

    // $allAdmins = getAllAdmins(); // Fetch all admin accounts

    ?>

    <div>
        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) : ?>
            
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
                        <div>
                            <a href="updateAccountView.php">Update Account</a>
                        </div>
                    </div>
                </div>

                <div class="title"><h1>Add New Admin</h1></div>
                <div class="form">

                    <form action="addAdmin.php" method="POST">
                        <table class="form-table">
                            <tr>
                                <td class="label-cell">
                                    <label for="username">Username:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($username); ?>" required>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="email">Email:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="email" id="email" name="email" required>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="password">Password:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="password" id="password" name="password" required>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="confirmPassword">Confirm Password:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" class="button-cell">
                                    <button type="submit" class="submit-button">Add Admin</button>
                                </td>
                            </tr>
                        </table>
                    </form>
            </div>

        <?php endif; ?>
    </div>

</body>
</html>