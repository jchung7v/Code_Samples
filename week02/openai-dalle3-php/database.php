<?php

    $servername = "127.0.0.1:3333";
    $username = "root";
    $password = "secret";
    $dbname = "ImageGenerator";

    $DBConnect = new mysqli($servername, $username, $password, $dbname);

    if ($DBConnect->connect_error) {
        die("<script>alert('Connection error: " . addslashes($DBConnect->connect_error) . "');</script>");
    }

    //create a databse if it does not exist
    if ($DBConnect !== FALSE) {
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        if ($DBConnect->query($sql) != TRUE) {
            echo "<script>alert('Error creating database: " . addslashes($DBConnect->error) . "');</script>";
        }
    }

    //create a table if it does not exist
    if ($DBConnect !== FALSE) {
        $TableName = "images";
        $SQLstring = "SHOW TABLES LIKE '$TableName'";
        $QueryResult = @mysqli_query($DBConnect, $SQLstring);
        if (mysqli_num_rows($QueryResult) == 0) {
            $SQLstring = "CREATE TABLE $TableName (imageID
                SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                prompts VARCHAR(300), base64 TEXT, saved_date DATE)";
            $QueryResult = @mysqli_query($DBConnect, $SQLstring);
            if ($QueryResult === FALSE)
                echo "<p>Unable to create the $TableName table.</p>"
                . "<p>Error code " . mysqli_errno($DBConnect)
                . ": " . mysqli_error($DBConnect) . "</p>";
            else
                echo "<script>alert('Successfully created the " . $TableName . " table.');</script>";
        }
    }
    
?>