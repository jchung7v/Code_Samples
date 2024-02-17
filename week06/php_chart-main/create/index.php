<?php include("../include_db.php"); ?>

<?php
echo "<hr /><h3>Create Student Table</h3>";
#===============================================
# Create table
#===============================================

$SQL_create_table = "CREATE TABLE IF NOT EXISTS Students (
    StudentId VARCHAR(10) NOT NULL,
    FirstName VARCHAR(80),
    LastName VARCHAR(80),
    School VARCHAR(50),
    PRIMARY KEY (StudentId)
);";

echo "<p>$SQL_create_table</p>";

$db->exec($SQL_create_table);

$db->close();
?>

<hr /><a href="/" >&lt;&lt; BACK</a>