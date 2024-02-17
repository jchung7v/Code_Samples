<?php include('../include_db.php'); ?>

<?php
    $count = $db->querySingle("SELECT count(*) from Students");

    // if empty, insert sample data
    if ($count == 0) {
        $row = 1;
        if (($handle = fopen("../data/seed-data.csv", "r")) !== FALSE) {
            $data = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                
                $num = count($data);
                echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
        
                $id = SQLite3::escapeString($data[0]);
                $firstName = SQLite3::escapeString($data[1]);
                $lastName = SQLite3::escapeString($data[2]);
                $school = SQLite3::escapeString($data[3]);
        
                $SQLinsert = "INSERT INTO Students (StudentId, FirstName, LastName, School)";
                $SQLinsert .= " VALUES "; 
                $SQLinsert .= " ('$id', '$firstName', '$lastName', '$school')";

                $db->exec($SQLinsert);
                $changes = $db->changes();
                echo "<p>The INSERT statement added $changes rows</p>";
            }
        }
    } 
    $db->close();
?>

<hr /><a href="/" >&lt;&lt; BACK</a>