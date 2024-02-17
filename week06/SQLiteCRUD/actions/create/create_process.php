<?php
    if (isset($_POST['create'])) {
        include("../../utils.php");
        include("../../connect_database.php");

        $version = $db->querySingle('SELECT SQLITE_VERSION()');

        extract($_POST);

        $tableName = 'Students';

        $StudentId = sanitize_input($StudentId);
        $FirstName = sanitize_input($FirstName);
        $LastName = sanitize_input($LastName);
        $School = sanitize_input($School);

        // Check if the Student ID already exists
        $checkDuplicateQuery = "SELECT COUNT(*) AS 'rowCount' FROM $tableName WHERE StudentId = ?";
        $checkStmt = $db->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(1, $StudentId, SQLITE3_TEXT);
        $result = $checkStmt->execute();
        $rowCount = $result->fetchArray(SQLITE3_NUM);
        $rowCount = $rowCount[0];


        if ($rowCount > 0) {
            header('Location: create.php?error=Student ID already exists');
            exit;
        }

        // Prepare and execute the INSERT query
        $SQL_insert_data = $db->prepare("INSERT INTO Students (StudentId, FirstName, LastName, School) VALUES (:StudentId, :FirstName, :LastName, :School)");
        
        // Bind parameters
        $SQL_insert_data->bindValue(':StudentId', $StudentId, SQLITE3_TEXT);
        $SQL_insert_data->bindValue(':FirstName', $FirstName, SQLITE3_TEXT);
        $SQL_insert_data->bindValue(':LastName', $LastName, SQLITE3_TEXT);
        $SQL_insert_data->bindValue(':School', $School, SQLITE3_TEXT);
        
        if (strlen($StudentId) > 10) {
            header('Location: create.php?error=Student ID should not be longer than 10 characters');
            exit;
        }
        
        // Execute the query
        $resultSet = $SQL_insert_data->execute();
        
        $db->close();
    }

    if ($resultSet !== false) {
        header('Location: ../../index.php');
        exit;
    }
?>