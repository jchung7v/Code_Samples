<?php
if (isset($_POST['StudentId'])) {

    $db_path = '../../school.db';
    $db_exists = file_exists($db_path);

    if ($db_exists) {
        $conn = new SQLite3($db_path);

        if ($conn) {
            $tableName = "Students";
            $id = $_POST['StudentId'];

            $stmt = $conn->prepare('DELETE FROM Students WHERE StudentId = :id');
            $stmt->bindValue(':id', $id, SQLITE3_TEXT);
            $exec = $stmt->execute();

            if (!$exec) {
                error_log('SQLite execute() failed: ' . $conn->lastErrorMsg());
            } else {
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
