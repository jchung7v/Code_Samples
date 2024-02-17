<?php
// Program to write a cookie to a client's machine
extract( $_POST );
// write each form field’s value to a cookie and set the
// cookie’s expiration date
setcookie( "Name", $name, time() + 60 * 60 * 24 * 5 );
setcookie( "Height", $height, time() + 60 * 60 * 24 * 5 );
setcookie( "Color", $color, time() + 60 * 60 * 24 * 5 );
?>
<!DOCTYPE HTML>
<html>
<head><title>Cookie Saved</title></head>
<body style = "font-family: arial, sans-serif">
<p>The cookie has been set with the following data:</p>
<!-- print each form field’s value -->
<b>Name:</b> <?php print( $name ) ?><br />
<b>Height:</b> <?php print( $height ) ?><br />
<b>Favorite Color:</b> <?php print( $color ) ?><br />
<p>Click <a href = "readCookies.php">here </a>to read the saved cookie.</p>
</body>
</html>
