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
