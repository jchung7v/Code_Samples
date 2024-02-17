<!DOCTYPE html>
<html lang="en">
<head>
<title>Create subscribers Table</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>Create subscribers Table</h1>
<?php
include("../3/inc_db_newsletter.php");
if ($DBConnect !== FALSE) {
     $TableName = "subscribers";
     $SQLstring = "SHOW TABLES LIKE '$TableName'";
     $QueryResult = @mysqli_query($DBConnect, $SQLstring);
     if (mysqli_num_rows($QueryResult) == 0) {
          $SQLstring = "CREATE TABLE subscribers (subscriberID
               SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
               name VARCHAR(80), email VARCHAR(100),
               subscribe_date DATE,
               confirmed_date DATE)";
          $QueryResult = @mysqli_query($DBConnect, $SQLstring);
          if ($QueryResult === FALSE)
               echo "<p>Unable to create the subscribers table.</p>"
               . "<p>Error code " . mysql_errno($DBConnect)
               . ": " . mysql_error($DBConnect) . "</p>";
          else
               echo "<p>Successfully created the "
               . "subscribers table.</p>";
     }
     else
          echo "<p>The subscribers table already exists.</p>";
     mysqli_close($DBConnect);
}
?>
<hr />
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
</div>
</body>
</html>

