<?php
    // Suspend PHP Errors. Only show explicitly printed messages
    error_reporting(0);

    $db = new SQLite3('userdata.db');

    try {
        insertUser($db, 'testUser', 'this is my password');
        insertUser($db, 'testUser2', 'this is my very new Password');
        echo "User Data has been successfully inserted";
    } catch (Exception $e) {
        echo "Error inserting user accounts in database: ".$e->getMessage();
    } finally {
        $db->close();
    }


    function insertUser($dbObject, $userName, $passWordString) {
        $sqlInsertStatement = $dbObject->prepare("INSERT INTO users (username, password) values (:user, :pass)");
        if(!$sqlInsertStatement) {
            throw new Exception("table users does not exist. Please first execute createDatbase.php");
        }

        // Actual Password hashing
        $hashedPassword = password_hash($passWordString, PASSWORD_DEFAULT);
        
        $sqlInsertStatement->bindValue(':user', $userName);
        // Using the hashed value as INSERT Parameter
        $sqlInsertStatement->bindValue(':pass', $hashedPassword);

        $sqlInsertStatement->execute();
    }

?>