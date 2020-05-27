<?php
    // Suspend PHP Errors. Only show explicitly printed messages
    error_reporting(0);
    
    $db = new SQLite3("userdata.db");

    try{
        $preparedStatement = $db->prepare("create table users (username TEXT Primary Key, password Text)");
        
        if(!$preparedStatement) {
            throw new Exception("table users already exits. Please delete userdata.db to reset the databse");
        }
        
        $preparedStatement->execute();

        echo 'Database created successfully';
    } catch (Exception $e) {
        echo "Execution Error: ".$e->getMessage();    
    } finally {
        $db->close();
    }


?>