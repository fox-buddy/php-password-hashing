<?php
    $db = new SQLite3("userdata.db");

    $preparedStatement = $db->prepare("create table users (username TEXT Primary Key, password Text)");
    $preparedStatement->execute();

    $db->close();

    echo "Database created";
?>