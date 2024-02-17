<!DOCTYPE html>
<html lang="en">
<head>
<title>Newsletter Subscribers (by column index number)</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>Newsletter Subscribers (by column index number)</h1>
<?php
include("../3/inc_db_newsletter.php");
if ($DBConnect !== FALSE) {
     $TableName = "subscribers";
     $SQLstring = "SELECT * FROM $TableName";
     if ($QueryResult = @mysqli_query($DBConnect, $SQLstring)) {
          echo "<table width='100%' class='table table-striped'>\n";
          echo "<tr><th>Subscriber ID</th>" .
               "<th>Name</th><th>Email</th>" .
               "<th>Subscribe Date</th>" .
               "<th>Confirm Date</th></tr>\n";
          while ($Row = mysqli_fetch_array($QueryResult, MYSQLI_NUM)) {
               echo "<tr><td>{$Row[0]}</td>";
               echo "<td>{$Row[1]}</td>";
               echo "<td>{$Row[2]}</td>";
               echo "<td>{$Row[3]}</td>";
               echo "<td>{$Row[4]}</td></tr>\n";
          };
          echo "</table>\n";

          echo "<p>Your query returned the above "
               . mysqli_num_rows($QueryResult)
               . " rows and ". mysqli_num_fields($QueryResult)
               . " columns.</p>";

          mysqli_free_result($QueryResult);
     }
     mysqli_close($DBConnect);
}
?>
<hr />
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
</div>
</body>
</html>

