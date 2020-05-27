<?php
    
    $db = new SQLite3('userdata.db');

    insertUser($db, 'testUser', 'this is my Password');
    insertUser($db, 'testUser2', 'this is my very new Password');
    
    $db->close();

    echo "Users inserted";

    function insertUser($dbObject, $userName, $passWordString) {
        $sqlInsertStatement = $dbObject->prepare("INSERT INTO users (username, password) values (:user, :pass)");
        
        $hashedPassword = password_hash($passWordString, PASSWORD_DEFAULT);
        
        $sqlInsertStatement->bindValue(':user', $userName);
        $sqlInsertStatement->bindValue(':pass', $hashedPassword);

        $sqlInsertStatement->execute();
    }

?>