<!DOCTYPE html>
<html lang="en">
<head>
<title>MySQL Server Information</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>MySQL Database Server Information</h1>
<?php
$DBConnect = mysqli_connect("127.0.0.1:3333", "root", "secret");
echo "<p>MySQL client version: " . mysqli_get_client_info() . "</p>\n";
if ($DBConnect===FALSE)
     echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n" ;
else {
     echo "<p>MySQL connection: " . mysqli_get_host_info($DBConnect) . "</p>\n";
     echo "<p>MySQL protocol version: " . mysqli_get_proto_info($DBConnect) . "</p>\n";
     echo "<p>MySQL server version: " . mysqli_get_server_info($DBConnect) . "</p>\n";
     mysqli_close($DBConnect);
}
?>
<hr />
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
</div>
</body>
</html>

