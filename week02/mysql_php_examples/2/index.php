<!DOCTYPE html>
<html lang="en">
<head>
<title>Creating Database</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>Creating Database</h1>
<?php
$DBName = "newsletter";
$DBConnect = mysqli_connect("127.0.0.1:3333", "root", "secret");
if ($DBConnect === FALSE)
     echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
else {    
     $sql = "CREATE DATABASE $DBName";
     if ($DBConnect->query($sql) === TRUE) {
          echo "Database $DBName created successfully";
     } else {
          echo "Error creating database: " . $DBConnect->error;
     }
     mysqli_close($DBConnect);
}
?>
<hr />
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
</div>
</body>
</html>

