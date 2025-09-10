<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Admin View</title>
    <link rel="stylesheet" href="css/updateAccount.css"> 
    <link rel="stylesheet" href="css/adminStyle.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- sweetalert2 installation script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jquery installation script -->
</head>
<body>
    
    <?php
        session_start(); // Start session
        include './models/model_admin.php'; // Include the model file

        $allAdmins = getAllAdmins(); // Fetch all the admin accounts

        $username = $_SESSION['username']; // Store current session's admin username
        // var_dump($username);

        $adminIDInt = getAdminID($username); // Use username to check and store admin id 
        // var_dump($adminIDInt);

        $currentAdminID = $adminIDInt['adminID'];
        // var_dump($currentAdminID);

        // Handle admin deletion
        if (isset($_POST['deleteAdmin'])) {
            $adminID = $_POST['deleteAdmin']; // Get the admin username to delete
            deleteAdmin($adminID); // Call the function to delete the admin
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
                            <a href="homeView2.php">Homepage</a>
                        </div>
                    </div>

                    <div class="logoutButton-updateAccountButton">
                        <div class="logoutButton">
                            <a href="loginView.php">Logout</a>
                        </div>
                    </div>
                </div>

                <div class="title"><br><div class="back-button"><a href="updateAccountView.php"><< Update Account</a></div><h1><?= ($currentAdminID === 1) ? "Delete Admin" : "Admins List"; ?></h1></div>

                <div class="admin-customers">
                    <table>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <?php if ($currentAdminID === 1): ?>
                                    <th></th>
                                <?php endif ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($allAdmins as $admins): ?>
                            <?php if ($admins["adminID"] != 1): ?>
                            <tr>
                                <td><?= $admins["adminID"] ?></td>
                                <td><?= $admins["username"] ?></td>
                                <td><?= $admins["phoneNumber"] ?></td>
                                <td><?= $admins["adminEmail"] ?></td>
                                <?php if ($currentAdminID === 1): ?>
                                    <td>
                                        <form method="POST" class="delete-admin-form">
                                            <input type="hidden" name="deleteAdmin" value="<?= $admins["adminID"]; ?>">
                                            <button type="submit" class="delete-button">Delete</button>
                                        </form>
                                        <script>
                                        document.querySelectorAll('.delete-admin-form').forEach(function(form) {
                                            form.addEventListener('submit', function(e) {
                                                e.preventDefault();
                                                Swal.fire({
                                                    title: 'Are you sure you want to permanently delete this admin?',
                                                    text: 'This action cannot be undone.',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Yes, delete',
                                                    cancelButtonText: 'Cancel'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        form.submit();
                                                    }
                                                });
                                            });
                                        });
                                        </script>
                                    </td>
                                <?php endif ?>
                            </tr>
                            <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        <?php else:
            header('Location: loginView.php'); // Redirect to login view if not logged in
            exit();
        endif ?>

    </div>
</body>
</html>