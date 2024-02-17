<?php include("../../inc_header.php"); ?>

<?php
if (isset($_POST['create'])) {

    include("../../inc_db_params.php");
    include("../../utils.php");

    /* change db to world db */
    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
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
            if ($checkStmt = mysqli_prepare($conn, $checkSql)) {
                mysqli_stmt_bind_param($checkStmt, "s", $StudentId);
                mysqli_stmt_execute($checkStmt);
                mysqli_stmt_store_result($checkStmt);
    
                if (mysqli_stmt_num_rows($checkStmt) > 0) {
                    mysqli_stmt_close($checkStmt);
                    echo "\n<p class='alert alert-danger'>StudentId $StudentId already exist.</p>\n";
                } else {
                    mysqli_stmt_close($checkStmt);
                    echo "Debug: StudentId $StudentId not found, ready to insert.";
    
                    $sql = "";
                    $sql .= "INSERT INTO Students (StudentId, FirstName, LastName, School) VALUES";
                    $sql .= "(?, ?, ?, ?)";
            
                    /* create a prepared statement */
                    if ($stmt = mysqli_prepare($conn, $sql)) {
            
                        /* bind parameters for markers */
                        mysqli_stmt_bind_param($stmt, "ssss", $StudentId, $FirstName, $LastName, $School);
            
                        /* execute query */
                        $exec = mysqli_stmt_execute($stmt);
            
                        if ($exec === false) {
                            error_log('mysqli execute() failed: ');
                            error_log(print_r(htmlspecialchars($stmt->error), true));
                        }
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            mysqli_close($conn);
        
            if ($exec === true) {
                header('Location: ../list');
                exit;
            }
        }
    };

}
?>

<br />

<div>
    <a href="../create/create.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;
</div>

<?php include("../../inc_footer.php"); ?>