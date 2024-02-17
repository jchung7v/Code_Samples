<?php
    if (isset($_POST['StudentId'])) {
        include("../../utils.php");
        include("../../connect_database.php");

        $version = $db->querySingle('SELECT SQLITE_VERSION()');

        extract($_POST);

        $tableName = 'Students';

        $id = $_POST['StudentId'];

        // Prepare and execute the INSERT query
        $SQL_delete_data = $db->prepare("DELETE FROM Students WHERE StudentId = :StudentId");
        
        // Bind parameters
        $SQL_delete_data->bindValue(':StudentId', $id, SQLITE3_TEXT);
        
        // Execute the query
        $resultSet = $SQL_delete_data->execute();
        
        $db->close();
    }

    if ($resultSet !== false) {
        header('Location: ../../index.php');
        exit;
    }
?>