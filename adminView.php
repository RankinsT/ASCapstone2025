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

    <script>
        // JavaScript function to collect customer data through browser prompts and submit via form
        function showAddCustomerForm() {
            // Display a prompt dialog asking user to enter first name
            // Returns the entered string or null if user clicks Cancel
            const firstName = prompt("Enter First Name:");
            // Check if user clicked Cancel (returns null), if so exit the function early
            if (firstName === null) return; // User cancelled
            
            // Display prompt for last name input
            const lastName = prompt("Enter Last Name:");
            // Exit early if user cancels last name entry
            if (lastName === null) return;
            
            // Display prompt for phone number input
            const phoneNumber = prompt("Enter Phone Number:");
            // Exit early if user cancels phone number entry
            if (phoneNumber === null) return;
            
            // Display prompt for email address input
            const email = prompt("Enter Email:");
            // Exit early if user cancels email entry
            if (email === null) return;
            
            // Display prompt for street address input
            const street = prompt("Enter Street Address:");
            // Exit early if user cancels street address entry
            if (street === null) return;
            
            // Display prompt for apartment/unit (this field is optional)
            // Note: No null check here, so user can skip this field
            const apt = prompt("Enter Apartment/Unit (optional):");
            
            // Display prompt for city input
            const city = prompt("Enter City:");
            // Exit early if user cancels city entry
            if (city === null) return;
            
            // Display prompt for state input
            const state = prompt("Enter State:");
            // Exit early if user cancels state entry
            if (state === null) return;
            
            // Display prompt for zipcode input
            const zipcode = prompt("Enter Zipcode:");
            // Exit early if user cancels zipcode entry
            if (zipcode === null) return;
            
            // Display prompt for notes (this field is optional)
            // Note: No null check here, so user can skip this field
            const notes = prompt("Enter Notes (optional):");
            
            // Create a new HTML form element dynamically in memory
            // This form will be used to submit the collected data to the server
            const form = document.createElement('form');
            // Set the form's submission method to POST (required for $_POST in PHP)
            form.method = 'POST';
            // Hide the form so it doesn't appear on screen (invisible submission)
            form.style.display = 'none';
            
            // Create an object containing all the form field names and their values
            // This maps form field names to the data collected from prompts
            const fields = {
                // Flag to indicate this is an "add customer" operation
                'addCustomer': '1',
                // User's entered first name
                'firstName': firstName,
                // User's entered last name
                'lastName': lastName,
                // User's entered phone number
                'phoneNumber': phoneNumber,
                // User's entered email address
                'email': email,
                // User's entered street address
                'street': street,
                // Use entered apartment or empty string if null (|| is logical OR operator)
                'apt': apt || '',
                // User's entered city
                'city': city,
                // User's entered state
                'state': state,
                // User's entered zipcode
                'zipcode': zipcode,
                // Use entered notes or empty string if null
                'notes': notes || ''
            };
            
            // Loop through each field name and value in the fields object
            // Object.entries() converts object to array of [key, value] pairs
            // Destructuring assignment extracts name and value from each pair
            for (const [name, value] of Object.entries(fields)) {
                // Create a new hidden input element for each field
                const input = document.createElement('input');
                // Set input type to hidden (won't be visible to user)
                input.type = 'hidden';
                // Set the name attribute (this becomes the $_POST key in PHP)
                input.name = name;
                // Set the value attribute (this becomes the $_POST value in PHP)
                input.value = value;
                // Add this input element as a child of the form
                form.appendChild(input);
            }
            
            // Add the completed form to the document body (makes it part of the page)
            document.body.appendChild(form);
            // Trigger form submission, which sends all the hidden inputs via POST to the server
            form.submit();
        }
    </script>

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
    
</body>
</html>