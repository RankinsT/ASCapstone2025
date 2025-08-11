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
                        <div>
                            <a href="addAdminView.php">Add Admin Account</a>
                        </div>
                    </div>
                </div>

                <div class="title"><h1>Update Information</h1></div>

                <div class="form">
                    <?php
                    // Get current user data from database
                    $currentUser = null;
                    if (isset($_SESSION['username'])) {
                        try {
                            include './models/db.php'; // Include database connection
                            
                            $stmt = $db->prepare("SELECT * FROM capstone_202540_qball.adminlogin WHERE username = ?");
                            $stmt->execute([$_SESSION['username']]);
                            $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                        } catch (PDOException $e) {
                            error_log("Database error: " . $e->getMessage());
                        }
                    }
                    ?>
                    
                    <form action="updateAccount.php" method="POST">
                        <table class="form-table">
                            <tr>
                                <td class="label-cell">
                                    <label for="username">Username:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="text" id="username" name="username" required value="<?= htmlspecialchars($_SESSION['username']); ?>">
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
                                    <label for="currentPassword">Current Password:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="password" id="currentPassword" name="currentPassword" required>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="newPassword">New Password:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="password" id="newPassword" name="newPassword" required>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-cell">
                                    <label for="confirmPassword">Confirm New Password:</label>
                                </td>
                                <td class="input-cell">
                                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" class="button-cell">
                                    <button type="submit" class="submit-button">Update Account</button>
                                </td>
                            </tr>
                        </table>
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