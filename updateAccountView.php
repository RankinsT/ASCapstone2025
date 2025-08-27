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

    $error = ""; // Initialize error message variable
    $newPassword = ""; // Initialize new password variable
    $confirmPassword = ""; // Initialize confirm password variable
    $username = $_SESSION['username'] ?? ''; // Get the current username from session
    $email = ""; // Initialize email variable
    $currentPassword = ""; // Initialize current password variable
    $user = getAdmin($username);
echo $user['phoneNumber'];
    ?>

    <div>
        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?>

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
                            <a href="addAdminView.php">Add Admin Account</a>
                        </div> -->
                    </div>
                </div>

                <div class="title"><br><div class="back-button"><a href="adminView.php">< Admin Page</a>&nbsp;&nbsp;<span style="font-weight: bold;">|</span>&nbsp;&nbsp;<a href="addAdminView.php">Add Admin ></a></div><h1>Update Information</h1></div>

                <div class="form">
                    
                    <?php
                    // Get current user data using model_admin.php function
                    $currentUser = null;
                    if (isset($_SESSION['username'])) {
                        $currentUser = getAdmin($_SESSION['username']);
                    }
                    ?>
                    
                    <form action="updateAccount.php" method="POST">
                        <table class="form-table">
                            <tr>
                                <td class="label-cell">
                                    <label for="username">Username:</label>
                                </td>
                                <td class="input-cell">
                                    <span id="username" style="display: inline-block; padding: 8px 12px; background: #f5f5f5; border-radius: 4px; border: 1px solid #ccc;">
                                        <?= htmlspecialchars($_SESSION['username']); ?>
                                    </span>
                                    <input type="hidden" name="username" value="<?= htmlspecialchars($_SESSION['username']); ?>">
                                </td>
                            </tr>

                            <tr>

                                <td class="label-cell">
                                    <label for="adminEmail">Email:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="email" id="adminEmail" name="adminEmail" required value="<?= htmlspecialchars($currentUser['adminEmail'] ?? ''); ?>">
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="phoneNumber">Phone Number:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="text" id="phoneNumber" name="phoneNumber" value="<?= htmlspecialchars($currentUser['phoneNumber'] ?? ''); ?>" placeholder="5555555555">
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="currentPassword">Current Password:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="password" id="currentPassword" name="currentPassword">
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="newPassword">New Password:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="password" id="newPassword" name="newPassword">
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="confirmPassword">Confirm New Password:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="password" id="confirmPassword" name="confirmPassword">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" class="button-cell">
                                    <button type="submit" class="submit-button">Update Account</button>
                                </td>
                            </tr>
                        </table>

                        <div>
                            <?php
                    // Show update success or error messages
                    if (!empty($_SESSION['update_success'])) {
                        echo '<div class="alert alert-success" style="color: green; margin-bottom: 15px; padding: 10px; border: 1px solid green; background-color: #f0fff0; border-radius: 4px; width: 80%;">' . htmlspecialchars($_SESSION['update_success']) . '</div>';
                        unset($_SESSION['update_success']);
                    }
                    if (!empty($_SESSION['update_error'])) {
                        echo '<div class="alert alert-error" style="color: red; margin-bottom: 15px; padding: 10px; border: 1px solid red; background-color: #fff0f0; border-radius: 4px; width: 80%;">' . htmlspecialchars($_SESSION['update_error']) . '</div>';
                        unset($_SESSION['update_error']);
                    }
                    ?>
                        </div>
                    </form>
                </div>

            </div>

        <?php else:
            header('Location: loginView.php'); // Redirect to login view if not logged in
            exit();
        endif; ?>
    </div>
    
</body>
</html>