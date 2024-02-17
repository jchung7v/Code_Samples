<?php include("../include_db.php"); ?>

<table border="1":>
<?php 

echo "<hr /><h3>List of students</h3>";

$res = $db->query('SELECT * FROM Students');

while ($row = $res->fetchArray()) {
    echo "<tr>\n";
    echo "<td>{$row['StudentId']}</td>";
    echo "<td>{$row['FirstName']}</td>";
    echo "<td>{$row['LastName']}</td>";
    echo "<td>{$row['School']}</td>";
    echo "<tr>\n";
}

?>
</table>
<hr /><a href="/" >&lt;&lt; BACK</a>