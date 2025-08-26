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

    $allAdmins = getAllAdmins(); // Fetch all admin accounts

    // Only process form if it was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        // Validation
        if ($username == "") $error .= "<li>Username is required</li>";
        if ($password == "") $error .= "<li>Password is required</li>";
        if ($confirmPassword == "") $error .= "<li>Confirm Password is required</li>";
        if ($email == "") $error .= "<li>Email is required</li>";
        if ($password !== $confirmPassword) $error .= "<li>Passwords do not match</li>";

        // Check for duplicate username
        foreach ($allAdmins as $admin) {
            if ($admin['username'] === $username) {
                $error .= "<li>Username already exists</li>";
                break;
            }
        }

        // If no errors, register the admin
        if ($error == "") {
            $result = register($username, $password, $email); // Call the register function to add the new admin
            
            // Debug: Let's see what the register function actually returns
            error_log("Register function returned: " . var_export($result, true));
            
            // Check if the admin was actually added by looking for them in the database
            $allAdmins = getAllAdmins(); // Refresh the admin list
            $userAdded = false;
            foreach ($allAdmins as $admin) {
                if ($admin['username'] === $username && $admin['adminEmail'] === $email) {
                    $userAdded = true;
                    break;
                }
            }
            
            if ($userAdded) { 
                // Success! Show alert and redirect to admin page
                echo "<script>
                    alert('Admin registered successfully!');
                    window.location.href = 'adminView.php';
                </script>";
                exit();
            } else {
                $error .= "<li>Failed to register admin - user not found in database</li>";
            }
        }
    }

    ?>

    <div>
        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) : ?>
            
            <div class="update-account-container">
                <div class="admin-header">
                    <div class="homepageButton-customerSearch">
                        <div class="homepageButton">
                            <a href="homeView2.php">Homepage</a>
                        </div>
                        <!-- <div class="homepageButton">
                            <a href="adminView.php">Admin Page</a>
                        </div> -->
                    </div>

                    <div class="logoutButton-updateAccountButton">
                        <div class="logoutButton">
                            <a href="loginView.php">Logout</a>
                        </div>
                        <!-- <div>
                            <a href="updateAccountView.php">Update Account</a>
                        </div> -->
                    </div>
                </div>

                <div class="title"><br><div class="back-button"><a href="updateAccountView.php">< Update Account</a></div><h1>Add New Admin</h1></div>
                <div class="form">

                    

                    <form action="addAdminView.php" method="POST">
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
                                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? ''); ?>" required>
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

                        <?php if (!empty($error)): ?>
                        <div class="alert alert-error" style="color: red; margin-bottom: 15px; padding: 10px; border: 1px solid red; background-color: #fff0f0; border-radius: 4px;">
                            <ul style="margin: 0; padding-left: 20px;">
                                <?= $error ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    </form>
            </div>

        <?php endif; ?>
    </div>

</body>
</html>