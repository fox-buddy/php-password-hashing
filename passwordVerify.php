<?php
    // Suspend PHP Errors. Only show explicitly printed messages
    error_reporting(0);

    $db = new SQLite3('userdata.db');

    // Enter User Data here to test the verification
    $userToCheckAgainstDatabase = 'testUser';
    $passwordToVerify = 'this is my password';

    // Query preparation and value binding. Error handling to ensure, the table exists
    try {
        $sqlSelectUser = $db->prepare('SELECT * from users where username = :user');
        if(!$sqlSelectUser) {
            throw new Exception("Table users does not exist. Pleasy execute createDatbase.php and insertUserPasswords.php in this order");
        }

        $sqlSelectUser->bindValue(':user', $userToCheckAgainstDatabase);
    } catch (Exception $e) {
        $db->close();
        echo "Error during Password validation: ".$e->getMessage();
        exit(1);
    }
    
    // Retrieving the data row as associative php array
    $queryResult = $sqlSelectUser->execute();
    $dataRow = $queryResult->fetchArray(SQLITE3_ASSOC);
    
    // Just a little Error handling
    if(!$dataRow) {
        echo "Error during Password validation: The provded user does not exist in the databse.";
        $db->close();
        exit(1);
    }

    // Getting the password from the associative Array
    $hashedPassword = $dataRow['password'];
    // Checking the provided password against the saved password (already hashed)
    $isThePasswordCorrect = password_verify($passwordToVerify, $hashedPassword);

    if($isThePasswordCorrect) {
        echo "The entered password is correct";
    } else {
        echo "The entered password is incorrect";
    }

    $db->close();

?>