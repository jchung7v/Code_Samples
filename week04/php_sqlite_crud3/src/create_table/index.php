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

    $db_path = '../school.db';
    $db_exists = file_exists($db_path);

    if ($db_exists) {
        $conn = new SQLite3($db_path);
        if ($conn !== FALSE) {
            $tableName = "Students";        
            $sql = "SELECT name FROM sqlite_master WHERE type='table' and name = '$tableName'";
            $result = $conn->query($sql);
            $row = $result->fetchArray(SQLITE3_NUM);
        
            if ($row > 0) {
                echo "\n<p class='alert alert-danger'>$tableName table already exist.</p>\n";
            } else {
                $SQL_create_table = "CREATE TABLE IF NOT EXISTS $tableName (
                    StudentId VARCHAR(10) NOT NULL,
                    FirstName VARCHAR(80),
                    LastName VARCHAR(80),
                    School VARCHAR(50),
                    PRIMARY KEY (StudentId)
                );";
                $conn->exec($SQL_create_table);
                echo "\n<p class='alert alert-success'>$tableName table created successfully</p>\n";
            }
        };
    } else {
        echo "\n<p class='alert alert-danger'>Create a database before creating a table.</p>\n";
    }
}
?>

<?php include("../inc_footer.php"); ?>