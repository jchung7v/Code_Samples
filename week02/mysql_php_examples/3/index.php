<!DOCTYPE html>
<html lang="en">
<head>
<title>Select database</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>Select database</h1>
<?php
include("inc_db_newsletter.php");
if ($DBConnect !== FALSE) {
     echo "<p>Selected the '$dbname' database</p>\n";
     mysqli_close($DBConnect);
}
?>
<hr />
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
</div>
</body>
</html>

