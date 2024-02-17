<?php include("../../inc_header.php"); ?>

<?php
if (isset($_GET['id'])) {
    $db_path = '../../school.db';
    $db_exists = file_exists($db_path);

    if ($db_exists) {
        $conn = new SQLite3($db_path);
        
        if ($conn) {
            $tableName = "Students";
            $id = $_GET['id'];

            $stmt = $conn->prepare('SELECT * FROM Students WHERE StudentId = :id');
            $stmt->bindValue(':id', $id, SQLITE3_TEXT);
            $result = $stmt->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);

            if ($row) {
                $StudentId = $row['StudentId'];
                $FirstName = $row['FirstName'];
                $LastName = $row['LastName'];
                $School = $row['School'];

            } else {
                echo "No records found for ID: $id";
            }

        } else {
            echo "Failed to connect to the database.";
        }
    } else {
        echo "Database does not exist.";
    }
}
?>

<h1>Update</h1>

<div class="row">
    <div class="col-md-4">
        <form action="process_update.php" method="post">

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
                <a href="../list" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Update" name="update" class="btn btn-warning" />
            </div>
        </form>
    </div>
</div>

<br />


<?php include("../../inc_footer.php"); ?>