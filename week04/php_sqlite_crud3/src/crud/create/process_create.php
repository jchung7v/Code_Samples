<?php include("../../inc_header.php"); ?>

<?php
if (isset($_POST['create'])) {

    include("../../utils.php");

    $db_path = '../../school.db';
    $db_exists = file_exists($db_path);

    if ($db_exists) {
        $conn = new SQLite3($db_path);

        if ($conn) {
            $tableName = "Students";
            extract($_POST);

            if (strlen($StudentId) > 10 || strlen($FirstName) > 80 || strlen($LastName) > 80 || strlen($School) > 50) {
                echo "\n<p class='alert alert-danger'>Invalid input length.</p>\n";
            } else {
                
                $StudentId = sanitize_input($StudentId);
                $FirstName = sanitize_input($FirstName);
                $LastName = sanitize_input($LastName);
                $School = sanitize_input($School);
        
                $exec = false;
        
                $checkSql = "SELECT StudentId FROM Students WHERE StudentId = ?";
                $checkStmt = $conn->prepare($checkSql);
                $checkStmt->bindValue(1, $StudentId, SQLITE3_TEXT);
                $result = $checkStmt->execute();
        
                if ($result->fetchArray()) {
                    echo "\n<p class='alert alert-danger'>StudentId $StudentId already exists.</p>\n";
                } else {
                    echo "\n<p class='alert alert-success'>New student is created.</p>\n";
        
                    $sql = "INSERT INTO Students (StudentId, FirstName, LastName, School) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(1, $StudentId, SQLITE3_TEXT);
                    $stmt->bindValue(2, $FirstName, SQLITE3_TEXT);
                    $stmt->bindValue(3, $LastName, SQLITE3_TEXT);
                    $stmt->bindValue(4, $School, SQLITE3_TEXT);
                
                    $exec = $stmt->execute();

                    if ($exec === false) {
                        error_log('SQLite3 execute() failed: ');
                        error_log(print_r($conn->lastErrorMsg(), true));
                    }
                }
            }
        }
    } else {
        echo "\n<p class='alert alert-danger'>Create a database and a table to create new student or see the list</p>\n";
    }
}
?>

<br />

<div>
    <a href="../create/create.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;
</div>

<?php include("../../inc_footer.php"); ?>