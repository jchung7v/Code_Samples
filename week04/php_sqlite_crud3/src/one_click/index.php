<?php include("../inc_header.php"); ?>

<h1>One-Click Student List</h1>

<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php
#===============================================
# Create Connection
#===============================================

$database_path = '../school.db';
$db_name = "school";
$tableName = "Students";
$conn = "";

try {
    $conn = new SQLite3($database_path);
    echo "\n<p class='alert alert-success'>Connected to the SQLite database successfully!</p>\n";
} catch (Exception $e) {
    echo "\n<p class='alert alert-danger'>Error connecting to the SQLite database: </p>\n" . $e->getMessage();
}

#===============================================
# Create Table
#===============================================
if ($conn !== FALSE) {

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

#===============================================
# Insert sample data into table
#===============================================

if ($conn !== FALSE) {

    # only proceed if table is empty
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

#===============================================
# Make a table
#===============================================

if ($conn !== FALSE) {
    
    $sql = "SELECT COUNT(*) as count FROM $tableName";
    $result = $conn->query($sql);
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row['count'] > 0) {
        echo "<table width='100%' class='table table-striped'>\n";
        echo "<tr><th>Student ID</th>".
             "<th>First Name</th>".
             "<th>Last Name</th>".
             "<th>School</th>\n";
             "<th>&nbsp;</th></tr>\n";
        $SQL_make_table = "SELECT * FROM $tableName";
        if ($result = $conn->query($SQL_make_table)) {
            while ($row = $result->fetchArray(SQLITE3_NUM)) {
                echo "<tr>";
                echo "<td>{$row[0]}</td>";
                echo "<td>{$row[1]}</td>";
                echo "<td>{$row[2]}</td>";
                echo "<td>{$row[3]}</td>";
                echo "</tr>\n";
            };
            echo "</table>\n";
        }
        echo "<p class='alert alert-success'>Table is generated successfully</p>\n";
    } else {
        echo "<p class='alert alert-danger'>Table is empty. Can't generate a list</p>\n";
    }
}

$conn->close();
?>

<?php include("../inc_footer.php"); ?>