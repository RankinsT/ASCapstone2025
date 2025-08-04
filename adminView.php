<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminView</title>

    <link rel="stylesheet" href="./css/adminStyle.css"> <!-- Link to your admin CSS file -->
</head>
<body>

    <?php

    session_start(); // Start the session


    include './models/model_admin.php'; // Include the model for admin functionalities

    $customers = getAllCustomers(); // Fetch all customers from the database

    ?>

    <div>
        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?>

            <!-- Your admin view content goes here -->

            <div class="admin-grid-container">
                <div class="admin-header">
                    <div class="homepageButton-customerSearch">
                        <div class="homepageButton">
                            <a href="homeView.php">Homepage</a>
                        </div>
                        <div class="customerSearch">
                            <div>
                                <input type="text" placeholder="Search customers" name="searchTerm">
                                <button>Search</button>
                                <button class="addCustomer-button">➕&nbsp;&nbsp;&nbsp;Add Customer</button>

                            </div>
                        </div>
                    </div>

                    <div class="logoutButton-updateAccountButton">
                        <div>
                            <a href="loginView.php">Logout</a>
                        </div>
                        <div>
                            <a href="updateAccountView.php">Update Account</a>
                        </div>
                    </div>
                </div>
                <!-- div /header -->

                <div class="admin-customers">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Street</th>
                                <th>APT</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zipcode</th>
                                <th>Notes</th>
                                <th>Date Added</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= $customer["ID"] ?></td>
                                <td><?= $customer["firstName"] ?></td>
                                <td><?= $customer["lastName"] ?></td>
                                <td><?= $customer["phoneNumber"] ?></td>
                                <td><?= $customer["email"] ?></td>
                                <td><?= $customer["street"] ?></td>
                                <td><?= $customer["apt"] ?></td>
                                <td><?= $customer["city"] ?></td>
                                <td><?= $customer["state"] ?></td>
                                <td><?= $customer["zipcode"] ?></td>
                                <td><?= $customer["notes"] ?></td>
                                <td><?= $customer["dateAdded"] ?></td>
                                <td><button class="edit-button">Edit</button></td>
                                <td><button class="delete-button">Delete</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- div /customers -->

                <div class="admin-add-customers">
                    add customer button?
                </div>
                <!-- div /add-customers -->

            </div>
            <!-- div /grid-container -->

        <?php else:
            header('Location: loginView.php'); // Redirect to login view if not logged in
            exit();
        endif; ?>
    </div>
    
</body>
</html>