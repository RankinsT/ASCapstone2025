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
                street = :street, apt = :apt, city = :city, state = :state, zipcode = :zipcode, notes = :notes 
            WHERE ID = :id';

    $stmt = $db->prepare($sql); // Prepare the SQL statement

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

function register($username, $password, $email) {
    global $db;

    $results = ""; // Initialize an empty string for results

    try {
        $sql = 'INSERT INTO capstone_202540_qball.adminlogin (username, password, adminEmail) 
                VALUES (:username, :password, :email)'; // SQL query to insert a new admin

        $stmt = $db->prepare($sql); // Prepare the SQL statement

        // Bind the parameters
        $bindsAdmin = array(
            ':username' => $username,
            ':password' => sha1("MY-TOP-SECRET-SALT$password"), // In a real application, ensure to hash the password
            ':email' => $email
        );
        if ($stmt->execute($bindsAdmin) && $stmt->rowCount() > 0) {
            $results = "Admin registered successfully"; // Set success message
        }   
    } catch (PDOException $e) {
        error_log("Error registering admin: " . $e->getMessage()); // Log any errors
        return "Error registering admin"; // Return error message
    }
    return $results; // Return the results message
}