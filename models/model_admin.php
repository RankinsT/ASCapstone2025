<?php


include __DIR__ . '/db.php'; // Include the database connection file
function login($username, $password) {
    global $db;

    // First try with plain text password (for older accounts)
    $stmt = $db->prepare('SELECT username FROM capstone_202540_qball.adminlogin WHERE username = :u AND password = :p');
    $stmt->bindValue(':u', $username);
    $stmt->bindValue(':p', $password);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        return true;  // Return true if login is successful with plain text
    }

    // If plain text failed, try with SHA1 hashed password with salt (for newer accounts)
    $hashedPassword = sha1("MY-TOP-SECRET-SALT$password");
    $stmt = $db->prepare('SELECT username FROM capstone_202540_qball.adminlogin WHERE username = :u AND password = :p');
    $stmt->bindValue(':u', $username);
    $stmt->bindValue(':p', $hashedPassword);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        return true;  // Return true if login is successful with SHA1 + salt
    }

    return false;  // Return false if both attempts failed
}

function getAllCustomers() {
    global $db;

    $results = []; // Initialize an empty array to hold customer data

    $sql = 'SELECT * FROM capstone_202540_qball.customers ORDER BY ID DESC '; // SQL query to select all customers ordered by ID

    $stmt = $db->prepare($sql); // Prepare the SQL statement

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    }

    return $results; // Return the array of customer data
}

function getCustomer($ID) {
    global $db;

    $results = []; // Initialize an empty array to hold customer data

    $sql = 'SELECT * FROM capstone_202540_qball.customers WHERE ID = :id'; // SQL query to select customer by ID


    $stmt = $db->prepare($sql); // Prepare the SQL statement

    $binds = array(
        ':id' => $ID // Bind the ID parameter
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
    }

    return $results; // Return the client data
}

function deleteCustomer($customerID) {
    global $db;

    $results = ""; // Initialize an empty string for results

    try {
        $sql = 'DELETE FROM capstone_202540_qball.customers WHERE ID = :id'; // SQL query to delete a customer by ID
        $stmt = $db->prepare($sql); // Prepare the SQL statement
        $stmt->bindValue(':id', $customerID); // Bind the ID parameter
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $results = "Customer deleted successfully"; // Set success message
        } else {
            $results = "No customer found with that ID"; // No customer found
        }
    } catch (PDOException $e) {
            error_log("Error deleting customer: " . $e->getMessage()); // Log any errors
            return "Error deleting customer"; // Return error message
    }
    return $results; // Return the results message
}

function addCustomer($customerData) {
    global $db;

    $results = ""; // Initialize an empty string for results

    $sql = 'INSERT INTO capstone_202540_qball.customers (firstName, lastName, phoneNumber, email, street, apt, city, state, zipcode, notes) 
            VALUES (:firstName, :lastName, :phoneNumber, :email, :street, :apt, :city, :state, :zipcode, :notes)';

    $stmt = $db->prepare($sql); // Prepare the SQL statement

    // Bind the customer data to the SQL statement
    $stmt->bindValue(':firstName', $customerData['firstName']);
    $stmt->bindValue(':lastName', $customerData['lastName']);
    $stmt->bindValue(':phoneNumber', $customerData['phoneNumber']);
    $stmt->bindValue(':email', $customerData['email']);
    $stmt->bindValue(':street', $customerData['street']);
    $stmt->bindValue(':apt', $customerData['apt']);
    $stmt->bindValue(':city', $customerData['city']);
    $stmt->bindValue(':state', $customerData['state']);
    $stmt->bindValue(':zipcode', $customerData['zipcode']);
    $stmt->bindValue(':notes', $customerData['notes']);

    if ($stmt->execute()) {
        $results = "Customer added successfully"; // Set success message
        return true; // Return true if the customer was added successfully
    } else {
        $results = "Error adding customer"; // Set error message
        error_log("Error adding customer: " . implode(", ", $stmt->errorInfo()));
        return false; // Return false if there was an error
    }
}

function updateCustomer($customerData) {
    global $db;

    $results = ""; // Initialize an empty string for results

    $sql = 'UPDATE capstone_202540_qball.customers 
            SET firstName = :firstName, lastName = :lastName, phoneNumber = :phoneNumber, email = :email, 
                street = :street, apt = :apt, city = :city, state = :state, zipcode = :zipcode, serviceRequested = :serviceRequested, notes = :notes 
            WHERE ID = :id';

    $stmt = $db->prepare($sql); // Prepare the SQL statement
    
    // Check required fields using customerData keys
    if (empty($customerData['firstName']) || empty($customerData['lastName']) || empty($customerData['email']) || empty($customerData['street']) || empty($customerData['city']) || empty($customerData['state']) || empty($customerData['zipcode'])) {
        error_log('Form incomplete: missing required fields in updateCustomer');
        return false;
    }

    // Bind the customer data to the SQL statement
    $stmt->bindValue(':id', $customerData['ID']);
    $stmt->bindValue(':firstName', $customerData['firstName']);
    $stmt->bindValue(':lastName', $customerData['lastName']);
    $stmt->bindValue(':phoneNumber', $customerData['phoneNumber']);
    $stmt->bindValue(':email', $customerData['email']);
    $stmt->bindValue(':street', $customerData['street']);
    $stmt->bindValue(':apt', $customerData['apt']);
    $stmt->bindValue(':city', $customerData['city']);
    $stmt->bindValue(':state', $customerData['state']);
    $stmt->bindValue(':zipcode', $customerData['zipcode']);
    $stmt->bindValue(':serviceRequested', $customerData['serviceRequested']);
    $stmt->bindValue(':notes', $customerData['notes']);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $results = "Customer updated successfully"; // Set success message
        } else {
            $results = "No changes made or customer not found"; // No changes made
        }
        return true; // Return true if the customer was updated successfully
    } else {
        error_log("Error updating customer: " . implode(", ", $stmt->errorInfo())); // Log any errors
        return false; // Return false if there was an error
    }
}

function editCustomer($customerID) {
    global $db;

    $results = []; // Initialize an empty array to hold customer data

    $sql = 'SELECT * FROM capstone_202540_qball.customers WHERE ID = :id'; // SQL query to select customer by ID

    $stmt = $db->prepare($sql); // Prepare the SQL statement

    $binds = array(
        ':id' => $customerID // Bind the ID parameter
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
    }

    return $results; // Return the client data
}

function searchCustomer($searchTerm) {
    global $db;

    $results = []; // Initialize an empty array to hold customer data

    // Create the search term with wildcards for partial matching
    $searchPattern = '%' . $searchTerm . '%';

    $sql = 'SELECT * FROM capstone_202540_qball.customers 
            WHERE firstName LIKE ? OR lastName LIKE ? OR email LIKE ? OR phoneNumber LIKE ? OR 
                  street LIKE ? OR city LIKE ? OR state LIKE ? OR zipcode LIKE ?
            ORDER BY ID DESC'; // SQL query to search customers across multiple fields

    $stmt = $db->prepare($sql); // Prepare the SQL statement

    // Execute with the same search pattern for all placeholders
    if ($stmt->execute([$searchPattern, $searchPattern, $searchPattern, $searchPattern, 
                       $searchPattern, $searchPattern, $searchPattern, $searchPattern])) {
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
        }
    } else {
        // Log any database errors
        error_log("Search query error: " . implode(", ", $stmt->errorInfo()));
    }

    return $results; // Return the search results
}

function getAllAdmins() {
    global $db;

    $results = []; // Initialize an empty array to hold admin data

    $sql = 'SELECT * FROM capstone_202540_qball.adminlogin'; // SQL query to select all admins ordered by ID

    $stmt = $db->prepare($sql); // Prepare the SQL statement

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    }

    return $results; // Return the array of admin data
}

function register($username, $password, $email, $phoneNumber) {
    global $db;

    $results = ""; // Initialize an empty string for results

    try {
        $sql = 'INSERT INTO capstone_202540_qball.adminlogin (username, password, adminEmail, phoneNumber) 
                VALUES (:username, :password, :email, :phoneNumber)'; // SQL query to insert a new admin

        $stmt = $db->prepare($sql); // Prepare the SQL statement

        // Bind the parameters
        $bindsAdmin = array(
            ':username' => $username,
            ':password' => sha1("MY-TOP-SECRET-SALT$password"), // In a real application, ensure to hash the password
            ':email' => $email,
            ':phoneNumber' => $phoneNumber
        );
        if ($stmt->execute($bindsAdmin) && $stmt->rowCount() > 0) {
            $results = "Admin registered successfully"; // Set success message
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("SQL Error registering admin: " . implode(", ", $errorInfo));
            $results = "SQL Error: " . htmlspecialchars($errorInfo[2]);
        }
    } catch (PDOException $e) {
        error_log("PDO Error registering admin: " . $e->getMessage()); // Log any errors
        return "PDO Error: " . htmlspecialchars($e->getMessage()); // Return error message
    }
    return $results; // Return the results message
}

function updateAccount($username, $email, $currentPassword, $newPassword, $phoneNumber) {
    global $db;
    $results = "";
    try {
        // First try with SHA1+salt (newer accounts)
        $sql = 'UPDATE capstone_202540_qball.adminlogin SET adminEmail = :email, password = :newPassword, phoneNumber = :phoneNumber WHERE username = :username AND password = :currentPassword';
        $stmt = $db->prepare($sql);
        $binds = array(
            ':email' => $email,
            ':newPassword' => sha1("MY-TOP-SECRET-SALT$newPassword"),
            ':username' => $username,
            ':phoneNumber' => $phoneNumber,
            ':currentPassword' => sha1("MY-TOP-SECRET-SALT$currentPassword")
        );
        $stmt->execute($binds);
        if ($stmt->rowCount() > 0) {
            $results = "Account updated successfully";
            return $results;
        }
        // If not, try with plain text (older accounts)
        $sql2 = 'UPDATE capstone_202540_qball.adminlogin SET adminEmail = :email, password = :newPassword, phoneNumber = :phoneNumber WHERE username = :username AND password = :currentPassword';
        $stmt2 = $db->prepare($sql2);
        $binds2 = array(
            ':email' => $email,
            ':newPassword' => sha1("MY-TOP-SECRET-SALT$newPassword"),
            ':username' => $username,
            ':currentPassword' => $currentPassword,
            ':phoneNumber' => $phoneNumber
        );
        $stmt2->execute($binds2);
        if ($stmt2->rowCount() > 0) {
            $results = "Account updated successfully";
        } else {
            $results = "No changes made or incorrect current password";
        }
    } catch (PDOException $e) {
        error_log("Error updating account: " . $e->getMessage());
        return "Error updating account";
    }
    return $results;
}

function getAdmin($username) {
    global $db;

    $admin = null;

    try {
        $sql = 'SELECT * FROM capstone_202540_qball.adminlogin WHERE username = :username';
        $stmt = $db->prepare($sql);
        $stmt->execute([':username' => $username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching admin: " . $e->getMessage());
    }
    return $admin;
}

function getAdminID($username) {
    global $db;

    $adminID = null;

    try {
        $sql = 'SELECT adminID FROM capstone_202540_qball.adminlogin WHERE username = :username';
        $stmt = $db->prepare($sql);
        $stmt->execute([':username' => $username]);
        $adminID = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching admin ID: " . $e->getMessage());
    }
    return $adminID;
}

function deleteAdmin($adminID) {
    global $db;

    $results = "";

    try {
        $sql = 'DELETE FROM capstone_202540_qball.adminlogin WHERE adminID = :adminID'; // SQL query to delete an admin by username
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':adminID', $adminID);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $results = "Admin deleted successfully"; // Set success message
        } else {
            $results = "Admin not found"; // Set failure message
        }
    } catch (PDOException $e) {
        error_log("Error deleting admin") . $e->getMessage(); // Log any errors
        return "Error deleting admin"; // Return error message
    }
    return $results;
}

function requestQuote($firstName, $lastName, $email, $phoneNumber, $street, $apt, $city, $state, $zip, $serviceRequested, $notes) {
    global $db;

    $results = ""; // Initialize an empty string for results

    try {
        $sql = 'INSERT INTO capstone_202540_qball.customers (firstName, lastName, phoneNumber, email, street, apt, city, state, zipcode, serviceRequested, notes) 
                VALUES (:firstName, :lastName, :phoneNumber, :email, :street, :apt, :city, :state, :zipcode, :serviceRequested, :notes)';

        $stmt = $db->prepare($sql);

        // Bind the parameters
        $binds = array(
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':email' => $email,
            ':phoneNumber' => $phoneNumber,
            ':street' => $street,
            ':apt' => $apt,
            ':city' => $city,
            ':state' => $state,
            ':zipcode' => $zip,
            ':serviceRequested' => $serviceRequested,
            ':notes' => $notes
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = "Quote request submitted successfully";
            // echo "<script>alert('$results');</script>";
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '$results'
                });
            </script>";
        } else {
            $errorInfo = $stmt->errorInfo();
            $errorMsg = "Quote request was NOT submitted. Reason: SQL Error: " . htmlspecialchars($errorInfo[2]);
            echo "<script>alert('$errorMsg');</script>";
            return $errorMsg;
        }
    } catch (PDOException $e) {
        error_log("Error requesting quote: " . $e->getMessage());
        $errorMsg = "Quote request was NOT submitted. Reason: PDO Error: " . htmlspecialchars($e->getMessage());
        echo "<script>alert('$errorMsg');</script>";
        return $errorMsg;
    }
    return $results;
}

function getAllTextBoxes() {
    global $db;
    $results = [];

    $sql = 'SELECT * FROM capstone_202540_qball.textboxes'; // SQL query to select all text boxes
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching text boxes: " . $e->getMessage());
    }

    return $results;
}

function getTextBox($ID) {
    global $db;

    $textBox = null;

    try {
        $sql = 'SELECT * FROM capstone_202540_qball.textboxes WHERE `ID` = :ID';
        $stmt = $db->prepare($sql);
        $stmt->execute([':ID' => $ID]);
        $textBox = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching text box: " . $e->getMessage());
    }

    return $textBox;
}

function getPhoneNumber($adminID) {
    global $db;

    $phoneNumber = null;

    try {
        $sql = 'SELECT phoneNumber FROM capstone_202540_qball.adminLogin WHERE adminID = :adminID';
        $stmt = $db->prepare($sql);
        $stmt->execute([':adminID' => $adminID]);
        $phoneNumber = $stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("Error fetching phone number: " . $e->getMessage());
    }

    return $phoneNumber;
}

// Update only email and phone number for an admin (no password change)
function updateContactInfo($username, $email, $phoneNumber) {
    global $db;
    $results = "";
    try {
        $sql = 'UPDATE capstone_202540_qball.adminlogin SET adminEmail = :email, phoneNumber = :phoneNumber WHERE username = :username';
        $stmt = $db->prepare($sql);
        $binds = array(
            ':email' => $email,
            ':phoneNumber' => $phoneNumber,
            ':username' => $username
        );
        $stmt->execute($binds);
        if ($stmt->rowCount() > 0) {
            $results = "Contact info updated successfully";
        } else {
            $results = "No changes made or user not found";
        }
    } catch (PDOException $e) {
        error_log("Error updating contact info: " . $e->getMessage());
        return "Error updating contact info";
    }
    return $results;
}