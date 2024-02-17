<?php include("../inc_header.php"); ?>

<h1>Create Sample Data</h1>
<p>Click on the below button to Insert sample Students data.</p>

<form action="/insert_sample_data/index.php" method="POST">
<p>
    <a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="Submit" name="Submit" value="Insert data" class="btn btn-small btn-success"/>
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
            $sql = "SELECT COUNT(*) as count FROM $tableName";
            $result = $conn->query($sql);
            $row = $result->fetchArray(SQLITE3_ASSOC);
        
            if ($row['count'] == 0) { 
                $SQL_insert_data = "INSERT INTO $tableName (StudentId, FirstName, LastName, School) 
                VALUES 
                ('S10012345', 'Elena', 'Morales', 'Engineering'),
                ('S10023456', 'Liam', 'Nguyen', 'Business'),
                ('S10034567', 'Ava', 'Johnson', 'Arts'),
                ('S10045678', 'Oliver', 'Smith', 'Science'),
                ('S10056789', 'Isabella', 'Garcia', 'Mathematics'),
                ('S10067890', 'Mason', 'Martinez', 'History'),
                ('S10078901', 'Sophia', 'Lam', 'English Literature'),
                ('S10089012', 'Ethan', 'Brown', 'Political Science'),
                ('S10090123', 'Mia', 'Davis', 'Psychology'),
                ('S10101234', 'Noah', 'Wilson', 'Environmental Science')
                ";
                $conn->exec($SQL_insert_data);
                $rowcount=$conn->changes();
                printf("<p class='alert alert-success'>$rowcount records were inserted.</p>\n");
            } else {
                printf("<p class='alert alert-danger'>$tableName table already contains sample data.</p>\n");
            }
        }
    } else {
        echo "\n<p class='alert alert-danger'>Create a database and a table before inserting sample data.</p>\n";
    }
}
?>

<?php include("../inc_footer.php"); ?>