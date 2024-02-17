<?php include("../../inc_header.php"); ?>

<h1>Display Student</h1>

<?php
    if (isset($_GET['id'])) {
    
        include("../../connect_database.php");

        $version = $db->querySingle('SELECT SQLITE_VERSION()');

        $id = $_GET['id'];
        $tableName = 'Students';

        // Check if ID exists
        $checkDuplicateQuery = "SELECT COUNT(*) AS 'rowCount' FROM $tableName WHERE StudentId = ?";
        $checkStmt = $db->prepare($checkDuplicateQuery);
        $checkStmt->bindParam(1, $id, SQLITE3_TEXT);
        $result = $checkStmt->execute();
        $rowCount = $result->fetchArray(SQLITE3_NUM);
        $rowCount = $rowCount[0];


        if ($rowCount == 0) {
            // The specified ID doesn't exist in the database
            echo "<p class='alert alert-danger'>Student with ID $id does not exist.</p>";
            echo "<a href='../../index.php' class='btn btn-small btn-primary'>&lt;&lt; BACK</a>";
            exit;
        }

        // Fetch student details
        $fetchQuery = "SELECT * FROM $tableName WHERE StudentId = ?";
        $fetchStmt = $db->prepare($fetchQuery);
        $fetchStmt->bindParam(1, $id, SQLITE3_TEXT);
        $result = $fetchStmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);

        // Assign values to variables
        $StudentId = $row['StudentId'];
        $FirstName = $row['FirstName'];
        $LastName = $row['LastName'];
        $School = $row['School'];
    };

    $db->close();
?>

<table>
    <tr>
        <td>Student ID:</td>
        <td><?php echo $StudentId ?></td>
    </tr>
    <tr>
        <td>First name: </td>
        <td><?php echo $FirstName ?></td>
    </tr>
    <tr>
        <td>Last name: </td>
        <td><?php echo $LastName ?></td>
    </tr>
    <tr>
        <td>School: </td>
        <td><?php echo $School ?></td>
    </tr>
</table>

<br />
<a href="../../index.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../../inc_footer.php"); ?>