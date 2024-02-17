<?php include("../inc_header.php"); ?>

<h1>Create Student Table</h1>
<p>Click on the below button to create a table named Students.</p>

<form action="/create_table/index.php" method="POST">
<p>
    <a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="Submit" name="Submit" value="Create Table" class="btn btn-small btn-success"/>
</p>
</form>

<?php
if (isset($_POST['Submit'])) {
    include("../inc_db_params.php");

    /* change db to world db */
    $tableName = "Students";
    if ($conn !== FALSE) {

        mysqli_select_db($conn, $db_name);

        $sql = "SHOW TABLES LIKE '$tableName'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "\n<p class='alert alert-danger'>$tableName table already exist.</p>\n";
        } else {
        $SQLstring = "CREATE TABLE IF NOT EXISTS $tableName (
            StudentId VARCHAR(10) NOT NULL,
            FirstName VARCHAR(80),
            LastName VARCHAR(80),
            School VARCHAR(50),
            PRIMARY KEY (StudentId)
        );";
        $QueryResult = @mysqli_query($conn, $SQLstring);
        echo "\n<p class='alert alert-success'>$tableName table created successfully</p>\n";
        }
    }

    $conn->close();
}
?>

<?php include("../inc_footer.php"); ?>