<?php
$servername = "127.0.0.1:3333";
$username = "root";
$password = "secret";
$dbname = "newsletter";

$DBConnect = new mysqli($servername, $username, $password, $dbname);
if ($DBConnect === FALSE)
     die( "<p>Connection error: " . mysqli_connect_error() . "</p>\n");
else if (@mysqli_select_db($DBConnect, $dbname) === FALSE) {
     echo "<p>Could not select the \"$DBName\" " .
          "database: " . mysqli_error($DBConnect) . "</p>\n";
     mysqli_close($DBConnect);
     $DBConnect = FALSE;
}

?>
