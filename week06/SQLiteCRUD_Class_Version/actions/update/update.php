<?php
include("../../inc_header.php");
include("../../utils.php");
include("../../connect_database.php");

echo "<h1>Update</h1>";

if (isset($_GET['id'])) {

    $version = $db->querySingle('SELECT SQLITE_VERSION()');

    $id = sanitize_input($_GET['id']);
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

<div class="row">
    <div class="col-md-4">
        <form action="update_process.php" method="post">

            <div class="form-group">
                <input type="hidden" value="<?php echo $StudentId ?>" name="StudentId" />
                <label class="control-label">Student ID</label>
                <?php echo $StudentId ?>
            </div>

            <div class="form-group">
                <label for="FirstName" class="control-label">First Name</label>
                <input for="FirstName" class="form-control" name="FirstName" id="FirstName" value="<?php echo $FirstName; ?>" />
            </div>

            <div class="form-group">
                <label for="LastName" class="control-label">Last Name</label>
                <input for="LastName" class="form-control" name="LastName" id="LastName" value="<?php echo $LastName; ?>" />
            </div>

            <div class="form-group">
                <label for="School" class="control-label">School</label>
                <input for="School" class="form-control" name="School" id="School" value="<?php echo $School; ?>" />
            </div>

            <div class="form-group">
                <a href="../../index.php" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Update" name="update" class="btn btn-warning" />
            </div>
        </form>
    </div>
</div>

<br />

<?php include("../../inc_footer.php"); ?>