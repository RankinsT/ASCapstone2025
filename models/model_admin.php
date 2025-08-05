<?php


include __DIR__ . '/db.php'; // Include the database connection file
function login($username, $password) {
    global $db;

    $stmt = $db->prepare('SELECT username FROM capstone_202540_qball.adminlogin WHERE username = :u AND password = :p');

    $stmt->bindValue(':u', $username);
    $stmt->bindValue(':p', $password); 

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        return true;  // Return true if login is successful
    }

    return false;  // Return false if login failed
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

// function searchCustomer($searchTerm, $searchField = 'all') {
//     global $db;

//     $results = []; // Initialize an empty array to hold customer data
    
//     // Build the SQL query based on the search field
//     if ($searchField === 'all') {
//         // Search across all specified fields
//         $sql = 'SELECT * FROM capstone_202540_qball.customers 
//                 WHERE firstName LIKE :searchTerm 
//                    OR lastName LIKE :searchTerm 
//                    OR phoneNumber LIKE :searchTerm 
//                    OR email LIKE :searchTerm 
//                    OR street LIKE :searchTerm
//                    OR apt LIKE :searchTerm
//                    OR city LIKE :searchTerm
//                    OR state LIKE :searchTerm
//                    OR zipcode LIKE :searchTerm
//                 ORDER BY ID';
        
//         $binds = array(
//             ':searchTerm' => '%' . $searchTerm . '%'
//         );
//     } else {
//         // Search in a specific field
//         switch ($searchField) {
//             case 'first_name':
//                 $sql = 'SELECT * FROM capstone_202540_qball.customers WHERE first_name LIKE :searchTerm ORDER BY ID';
//                 break;
//             case 'last_name':
//                 $sql = 'SELECT * FROM capstone_202540_qball.customers WHERE last_name LIKE :searchTerm ORDER BY ID';
//                 break;
//             case 'city':
//                 $sql = 'SELECT * FROM capstone_202540_qball.customers WHERE city LIKE :searchTerm ORDER BY ID';
//                 break;
//             case 'state':
//                 $sql = 'SELECT * FROM capstone_202540_qball.customers WHERE state LIKE :searchTerm ORDER BY ID';
//                 break;
//             default:
//                 return $results; // Return empty array for invalid field
//         }
        
//         $binds = array(
//             ':searchTerm' => '%' . $searchTerm . '%'
//         );
//     }

//     $stmt = $db->prepare($sql); // Prepare the SQL statement

//     if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
//         $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
//     }

//     return $results; // Return the array of customer data
// }

// function advancedSearchCustomer($firstName = '', $lastName = '', $city = '', $state = '') {
//     global $db;

//     $results = []; // Initialize an empty array to hold customer data
    
//     // Build dynamic WHERE clause
//     $whereConditions = [];
//     $binds = [];
    
//     if (!empty($firstName)) {
//         $whereConditions[] = 'first_name LIKE :firstName';
//         $binds[':firstName'] = '%' . $firstName . '%';
//     }
    
//     if (!empty($lastName)) {
//         $whereConditions[] = 'last_name LIKE :lastName';
//         $binds[':lastName'] = '%' . $lastName . '%';
//     }
    
//     if (!empty($city)) {
//         $whereConditions[] = 'city LIKE :city';
//         $binds[':city'] = '%' . $city . '%';
//     }
    
//     if (!empty($state)) {
//         $whereConditions[] = 'state LIKE :state';
//         $binds[':state'] = '%' . $state . '%';
//     }
    
//     // If no search criteria provided, return empty array
//     if (empty($whereConditions)) {
//         return $results;
//     }
    
//     // Build the complete SQL query
//     $sql = 'SELECT * FROM capstone_202540_qball.customers WHERE ' . implode(' AND ', $whereConditions) . ' ORDER BY ID';
    
//     $stmt = $db->prepare($sql); // Prepare the SQL statement

//     if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
//         $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
//     }

//     return $results; // Return the array of customer data
// }

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