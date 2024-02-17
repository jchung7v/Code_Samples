<!DOCTYPE HTML>
<html>
<head><title>Read Cookies</title></head>
<body style = "font-family: arial, sans-serif">
<p>The following data was read from a cookie on this computer.</p>
<table border="5" cellspacing="0" cellpadding="10">
<?php
// iterate through array $_COOKIE and print
// name and value of each cookie
foreach ( $_COOKIE as $key => $value )
print( "<tr>
<td bgcolor='#F0E68C'>$key</td>
<td bgcolor='#FFA500'>$value</td>
</tr>" );
?>
</table>
</body>
</html>