<?php

include __DIR__ . '/dp.php'; // Include the database connection file
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

//
/* Code for login insert at top  php
session_start();
$_SESSION['isLoggedIn'] = false;
$_SESSION['username'] = '';
$error = '';

if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);

    if(login($username, $password)){
        $_SESSION['isLogginIn'] = true;
        $_SESSION['username'] = $username;
        header('Location: homeView.php'); test location to see if login working 
    }
    else{
        $error = "You did not provide correct creds";
    }
/*
/* Code for error handling Insert into a div in html
        <?php
            if ($error != "") {
        ?>
        <div class="error"><?php echo $error; ?></div>
        <?php
            }
        ?>


}
//