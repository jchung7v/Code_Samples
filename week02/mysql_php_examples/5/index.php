<!DOCTYPE html>
<html lang="en">
<head>
<title>Subscribe to our Newsletter</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<h1>Subscribe to our Newsletter</h1>
<?php
if (isset($_POST['Submit'])) {
     $FormErrorCount = 0;
     if (isset($_POST['SubscriberName'])) {
          $SubscriberName = stripslashes($_POST['SubscriberName']);
          $SubscriberName = trim($SubscriberName);
          if (strlen($SubscriberName) == 0) {
               echo "<p>You must include your name!</p>\n";
               ++$FormErrorCount;
          }
     }
     else {
          echo "<p>Form submittal error (No 'SubscriberName' field)!</p>\n";
          ++$FormErrorCount;
     }
     if (isset($_POST['SubscriberEmail'])) {
          $SubscriberEmail = stripslashes($_POST['SubscriberEmail']);
          $SubscriberEmail = trim($SubscriberEmail);
          if (strlen($SubscriberName) == 0) {
               echo "<p>You must include your email address!</p>\n";
               ++$FormErrorCount;
          }
     }
     else {
          echo "<p>Form submittal error (No 'SubscriberEmail' field)!</p>\n";
          ++$FormErrorCount;
     }
     if ($FormErrorCount == 0) {
          $ShowForm = FALSE;
          include("../3/inc_db_newsletter.php");
          if ($DBConnect !== FALSE) {
               $TableName = "subscribers";
               $SubscriberDate = date("Y-m-d");
               $SQLstring = "INSERT INTO $TableName " .
                    "(name, email, subscribe_date) VALUES " .
                    "('$SubscriberName', '$SubscriberEmail', '$SubscriberDate')";
               $QueryResult = @mysqli_query($DBConnect, $SQLstring);
               if ($QueryResult === FALSE)
                    echo "<p>Unable to insert the values into the subscriber table.</p>"
                       . "<p>Error code " . mysqli_errno($DBConnect)
                       . ": " . mysqli_error($DBConnect) . "</p>";
               else {
                    $SubscriberID = mysqli_insert_id($DBConnect);
                    echo "<p>" . htmlentities($SubscriberName) .
                         ", you are now subscribed to our newsletter.<br />";
                    echo "Your subscriber ID is $SubscriberID.<br />";
                    echo "Your email address is " .
                         htmlentities($SubscriberEmail) . ".</p>";
               }
               mysqli_close($DBConnect);
          }
     }
     else
        $ShowForm = TRUE;
}
else {
     $ShowForm = TRUE;
     $SubscriberName = "";
     $SubscriberEmail = "";
}
if ($ShowForm) {
?>

<form action="/5/index.php" method="POST">
<p><strong>Your Name: </strong>
<input type="text" name="SubscriberName" value="<?php echo $SubscriberName; ?>" /></p>
<p><strong>Your Email Address: </strong>
<input type="text" name="SubscriberEmail" value="<?php echo $SubscriberEmail; ?>" /></p>
<p><input type="Submit" name="Submit" value="Submit" class="btn btn-small btn-success"/></p>
</form>

<?php
}
?>
<hr />
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
</div>
</body>
</html>

