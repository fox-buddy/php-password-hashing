<?php
    $db = new SQLite3("userdata.db");

    $preparedStatement = $db->prepare("create table users (username TEXT, password Text)");
    $creationResult = $preparedStatement->execute();

    $usernameToInsert = "testuser";
    $passwortToInsert = "This is my Passwort";

    $sqlInsertStatement = $db->prepare("INSERT INTO users (username, password) values (:user, :pass)");
    $sqlInsertStatement->bindValue(':user', $usernameToInsert);
    $sqlInsertStatement->bindValue(':pass', $passwortToInsert);

    $insertResult = $sqlInsertStatement->execute();

    echo "We're done";
?>