<?php

include("connect_database.php");

$version = $db->querySingle('SELECT SQLITE_VERSION()');

// Create Students table if it does not exist
$SQL_create_table = "CREATE TABLE IF NOT EXISTS Students (
    StudentId VARCHAR(10) NOT NULL,
    FirstName VARCHAR(80),
    LastName VARCHAR(80),
    School VARCHAR(50),
    PRIMARY KEY (StudentId)
);";

$db->exec($SQL_create_table);

// Insert data if table is empty
$tableName = 'Students';
$query_rows = $db ->query("SELECT COUNT(*) AS 'rowCount' FROM $tableName");
$result = $query_rows->fetchArray(SQLITE3_ASSOC);
$rowCount = $result['rowCount'];

if ($rowCount == 0) {
    $SQL_insert_data = "INSERT INTO Students (StudentId, FirstName, LastName, School)
    VALUES
    ('A00111111', 'Tom', 'Max', 'Science'),
    ('A00222222', 'Ann', 'Fay', 'Mining'),
    ('A00333333', 'Joe', 'Sun', 'Nursing'),
    ('A00444444', 'Sue', 'Fox', 'Computing'),
    ('A00555555', 'Ben', 'Ray', 'Mining')
    ";

    $db->exec($SQL_insert_data);
}

echo "<p><a class='btn btn-small btn-success' href='/actions/create/create.php'>Create New</a></p>";

$resultSet = $db->query('SELECT * FROM Students');

$col0 = $resultSet->columnName(0);
$col1 = $resultSet->columnName(1);
$col2 = $resultSet->columnName(2);
$col3 = $resultSet->columnName(3);

echo "<table width='100%' class='table table-striped'>\n";
echo "<tr><th>$col0</th>".
     "<th>$col1</th>".
     "<th>$col2</th>".
     "<th>$col3</th>".
     "<th>Actions</th></tr>\n";

while ($row = $resultSet->fetchArray()) {
    echo "<tr><td>{$row[0]}</td>";
    echo "<td>{$row[1]}</td>";
    echo "<td>{$row[2]}</td>";
    echo "<td>{$row[3]}</td>";
    echo "<td>";
    echo "<a class='btn btn-small btn-primary' href='/actions/display/display.php?id={$row[0]}'>disp</a>";
    echo "&nbsp;";
    echo "<a class='btn btn-small btn-warning' href='/actions/update/update.php?id={$row[0]}'>upd</a>";
    echo "&nbsp;";
    echo "<a class='btn btn-small btn-danger' href='/actions/delete/delete.php?id={$row[0]}'>del</a>";
    echo "</td></tr>\n";
}
echo "</table>\n";

$db->close();

?>