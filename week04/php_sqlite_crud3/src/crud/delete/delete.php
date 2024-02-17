<?php include("../../inc_header.php"); ?>

<h1>Delete Student</h1>

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

            if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
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
<form action="process_delete.php" method="post">
    <input type="hidden" value="<?php echo $StudentId ?>" name="StudentId" />
    <a href="../list" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;
    <input type="submit" value="Delete" class="btn btn-danger" />
</form>

<br />


<?php include("../../inc_footer.php"); ?>