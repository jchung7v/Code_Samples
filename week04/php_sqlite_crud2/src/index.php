<!-- <?php include("inc_header.php"); ?> -->

<!DOCTYPE html>
<html lang="en">
<head>
<title>w04Lab</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<!-- <div style="width: 80%; margin: auto;">
    <a href="/">
        <img src="/images/bcit_banner904x150.png" alt="BCIT Banner" />
    </a>
</div> -->
<div class="container">

<h1>Student List</h1>
<h3>Juan Chung</h3>
<br>
<div style="font-size: x-large;">
    <p class='alert alert-warning'>
        Use this command to run server in a container listening on port 80: 
        docker run -p 8888:80 jchung150/comp3975
    </p>
</div>

<?php
#===============================================
# Create Connection
#===============================================

$database_path = './school.db';
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
        ('A00111111', 'Tom', 'Max', 'Science'),
        ('A00222222', 'Ann', 'Fay', 'Mining'),
        ('A00333333', 'Joe', 'Sun', 'Nursing'),
        ('A00444444', 'Sue', 'Fox', 'Computing'),
        ('A00555555', 'Ben', 'Ray', 'Mining')
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

</div>
</body>
</html>