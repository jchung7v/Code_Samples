<?php include("../../inc_header.php"); ?>

<h1>List of Students</h1>

<p>
<a href="/crud/create/create.php" class="btn btn-small btn-success">Create New</a>
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
</p>

<?php
$db_path = '../../school.db';
$db_exists = file_exists($db_path);

if ($db_exists) {
    $conn = new SQLite3($db_path);
    if ($conn !== FALSE) {
        $tableName = "Students";
        $sql = "SELECT COUNT(*) as count FROM $tableName";
        $result = $conn->query($sql);
        $row = $result->fetchArray(SQLITE3_ASSOC);
    
        if ($row['count'] > 0) {
            echo "<table width='100%' class='table table-striped'>\n";
            echo "<tr><th>Student ID</th>".
                 "<th>First Name</th>".
                 "<th>Last Name</th>".
                 "<th>School</th>".
                 "<th>&nbsp;</th>";
            $SQL_make_table = "SELECT * FROM $tableName";
            if ($result = $conn->query($SQL_make_table)) {
                while ($row = $result->fetchArray(SQLITE3_NUM)) {
                  echo "<tr>";
                  echo "<td>{$row[0]}</td>";
                  echo "<td>{$row[1]}</td>";
                  echo "<td>{$row[2]}</td>";
                  echo "<td>{$row[3]}</td>";
                  echo "<td>";
                  echo "<a class='btn btn-small btn-primary' href='/crud/display/display.php?id={$row[0]}'>disp</a>";
                  echo "&nbsp;";
                  echo "<a class='btn btn-small btn-warning' href='/crud/update/update.php?id={$row[0]}'>upd</a>";
                  echo "&nbsp;";
                  echo "<a class='btn btn-small btn-danger' href='/crud/delete/delete.php?id={$row[0]}'>del</a>";
                  echo "</td></tr>\n";
                };
                echo "</table>\n";
            }
        } else {
            echo "<p class='alert alert-danger'>Table is empty. Can't generate a list</p>\n";
        }
    } 
} else {
    echo "\n<p class='alert alert-danger'>Create a database and a table to create new student or see the list</p>\n";
}
?>


<?php include("../../inc_footer.php"); ?>