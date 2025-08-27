<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Admin View</title>
    <link rel="stylesheet" href="css/updateAccount.css"> 
    <link rel="stylesheet" href="css/adminStyle.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- sweetalert2 installation script -->
</head>
<body>
    
    <?php
        session_start(); // Start session
        include './models/model_admin.php'; // Include the model file

        $adminlogin = getAllAdmins(); // Fetch all the admin accounts

        $username = $_SESSION['username']; // Store current session's admin username
        $adminID = getAdminID($username); // Use username to check and store admin id 

        // print_r($adminID);

        // Handle admin deletion
        if (isset($_POST['deleteAdmin'])) {
            $username = $_POST['deleteAdmin']; // Get the admin username to delete
            deleteAdmin($username); // Call the function to delete the admin
            header('Location: deleteAdminView.php'); // Redirect to the delete admin view after deletion
            exit();
        }
    ?>

    <div>

        <?php if (isset($_SESSION['isLoggedIn']) && ($_SESSION['isLoggedIn'])): ?> <!-- Check if user is logged in as admin -->

            <div class="admin-delete-container">
                <div class="admin-header">
                    <div class="homepageButton-deleteAdmin">
                        <div class="homepageButton">
                            <a href="homeView.php">Homepage</a>
                        </div>
                    </div>

                    <div class="logoutButton-updateAccountButton">
                        <div class="logoutButton">
                            <a href="loginView.php">Logout</a>
                        </div>
                    </div>
                </div>

                <div class="title"><br><div class="back-button"><a href="updateAccountView.php"><< Update Account</a></div><h1>Delete Admin</h1></div>

                <div class="admin-customers">
                    <table>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Admin Email</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($adminlogin as $admins): ?>
                            <tr>
                                <td><?= $admins["adminID"]?></td>
                                <td><?= $admins["username"] ?></td>
                                <td><?= $admins["password"] ?></td>
                                <td><?= $admins["adminEmail"] ?></td>

                                <?php if ($adminID = 1): ?>
                                    <td>
                                        <form method="POST" style="display: inline;" onsubmit= sweetAlertConfirm()> <!--"return confirm('Are you sure you want to delete this admin?');" -->
                                            <input type="hidden" name="deleteAdmin" value="<?= $admins["username"] ?>">
                                            <button type="submit" class="delete-button">Delete</button>
                                        </form>
                                    </td>
                                    <?php endif ?>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>

        <?php endif ?>

    </div>
</body>
</html>