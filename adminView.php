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

    // Handle adding a new customer
    // Check if the form was submitted with the 'addCustomer' field present in POST data
    if (isset($_POST['addCustomer'])) {
        // Create an associative array to store all customer information
        // The ?? operator provides a default empty string if the POST value doesn't exist
        $customerData = [
            // Extract first name from form submission, default to empty string if not set
            'firstName' => $_POST['firstName'] ?? '',
            'lastName' => $_POST['lastName'] ?? '',
            'phoneNumber' => $_POST['phoneNumber'] ?? '',
            'email' => $_POST['email'] ?? '',
            'street' => $_POST['street'] ?? '',
            'apt' => $_POST['apt'] ?? '',
            'city' => $_POST['city'] ?? '',
            'state' => $_POST['state'] ?? '',
            'zipcode' => $_POST['zipcode'] ?? '',
            'notes' => $_POST['notes'] ?? ''
        ];
        
        // Call the addCustomer function from model_admin.php, passing the customer data array
        // This function will insert the new customer into the database and return a result message
        $result = addCustomer($customerData);
        
        // Check if the returned result message contains the word 'successfully'
        // strpos() returns the position of the substring, or false if not found
        // !== false ensures we're checking for actual presence, not position 0
        if (strpos($result, 'successfully') !== false) {
            // Output JavaScript alert to show success message to the user
            echo "<script>alert('Customer added successfully!');</script>";
        } else {
            // If operation failed, show error message
            // addslashes() escapes quotes in the result string to prevent JavaScript syntax errors
            echo "<script>alert('Error adding customer: " . addslashes($result) . "');</script>";
        }
        
        // Redirect the browser back to the same page (adminView.php) to refresh the customer list
        // This prevents duplicate submissions if the user refreshes the page
        header('Location: adminView.php'); // Redirect to refresh the page
        // Immediately stop script execution to ensure the redirect happens
        exit();
    }

    $customers = getAllCustomers(); // Fetch all customers from the database

    if (isset($_POST['deleteCustomer'])) {
        $customerID = $_POST['deleteCustomer']; // Get the customer ID to delete
        deleteCustomer($customerID); // Call the function to delete the customer
        header('Location: adminView.php'); // Redirect to the admin view after deletion
        exit();
    }

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
                                <button class="addCustomer-button" onclick="showAddCustomerForm()" type="button">➕&nbsp;&nbsp;&nbsp;Add Customer</button>
                            </div>
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
                                <td>
                                    <form action="editCustomerView.php" method="GET">
                                        <input type="hidden" name="editCustomer" value="<?= $customer["ID"] ?>">
                                        <button class="edit-button">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                        <input type="hidden" name="deleteCustomer" value="<?= $customer["ID"] ?>">
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- div /customers -->

                <div class="footer">
                    
                </div>
                <!-- div /add-customers -->

            </div>
            <!-- div /grid-container -->

        <?php else:
            header('Location: loginView.php'); // Redirect to login view if not logged in
            exit();
        endif; ?>
    </div>

    <script src="script.js"></script>
</body>
</html>