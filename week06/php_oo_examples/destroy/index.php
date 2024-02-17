<?php
	require_once('Stuff.php');
	$stuff = new Stuff(); // constructor is called
	unset ($stuff);	// destructor is called
?>
<hr />
<?php show_source('Stuff.php'); ?>
<hr />
<?php show_source('index.php'); ?>