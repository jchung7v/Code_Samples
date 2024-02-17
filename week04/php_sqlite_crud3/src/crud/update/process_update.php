<?php
if (isset($_POST['update'])) {

    include("../../utils.php");

    $db_path = '../../school.db';
    $db_exists = file_exists($db_path);

    if ($db_exists) {
        $conn = new SQLite3($db_path);
        
        if ($conn) {
            $tableName = "Students";
            extract($_POST);

            $StudentId = sanitize_input($StudentId);
            $FirstName = sanitize_input($FirstName);
            $LastName = sanitize_input($LastName);
            $School = sanitize_input($School);

            // Prepare the SQL update statement with placeholders
            $sql = "UPDATE Students SET FirstName = :FirstName, LastName = :LastName, School = :School WHERE StudentId = :StudentId";

            // Create a prepared statement
            $stmt = $conn->prepare($sql);

            // Bind parameters to the prepared statement
            $stmt->bindValue(':FirstName', $FirstName, SQLITE3_TEXT);
            $stmt->bindValue(':LastName', $LastName, SQLITE3_TEXT);
            $stmt->bindValue(':School', $School, SQLITE3_TEXT);
            $stmt->bindValue(':StudentId', $StudentId, SQLITE3_TEXT);

            // Execute the query
            $exec = $stmt->execute();

            if ($exec === false) {
                error_log('SQLite execute() failed: ' . $conn->lastErrorMsg());
            } else {
                // If the update was successful, redirect to the listing page
                header('Location: ../list');
                exit;
            }
        } else {
            echo "Failed to connect to the database.";
        }
    } else {
        echo "Database does not exist.";
    }
}
?>
