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