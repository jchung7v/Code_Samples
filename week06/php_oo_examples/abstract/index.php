<?php
  spl_autoload_register(function($className) {
    require_once("classes/$className.php");
  });

  $people[] = new Man("Fred");
  $people[] = new Woman("Jane");

  foreach($people as $person) {
    echo $person->gender() . "<br />";
  }
?>
<hr />
<?php show_source('classes/Human.php'); ?>
<hr />
<?php show_source('classes/Man.php'); ?>
<hr />
<?php show_source('classes/Woman.php'); ?>
<hr />
<?php show_source('index.php'); ?>