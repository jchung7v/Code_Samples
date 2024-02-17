<?php
    if (isset($_POST['update'])) {
        include("../../utils.php");
        include("../../connect_database.php");

        $version = $db->querySingle('SELECT SQLITE_VERSION()');

        extract($_POST);

        $tableName = 'Students';

        $StudentId = sanitize_input($StudentId);
        $FirstName = sanitize_input($FirstName);
        $LastName = sanitize_input($LastName);
        $School = sanitize_input($School);

        // Prepare and execute the INSERT query
        $SQL_update_data = $db->prepare("UPDATE Students SET FirstName = :FirstName, LastName = :LastName, School = :School WHERE StudentId = :StudentId");
        
        // Bind parameters
        $SQL_update_data->bindValue(':StudentId', $StudentId, SQLITE3_TEXT);
        $SQL_update_data->bindValue(':FirstName', $FirstName, SQLITE3_TEXT);
        $SQL_update_data->bindValue(':LastName', $LastName, SQLITE3_TEXT);
        $SQL_update_data->bindValue(':School', $School, SQLITE3_TEXT);
        
        // Execute the query
        $resultSet = $SQL_update_data->execute();
        
        $db->close();
    }

    if ($resultSet !== false) {
        header('Location: ../../index.php');
        exit;
    }
?>