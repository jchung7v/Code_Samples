<?php
  spl_autoload_register(function($className) {
    require_once("classes/$className.php");
  });

  // call a static method
  Stuff::test();
?>
<hr />
<?php show_source('classes/Stuff.php'); ?>
<hr />
<?php show_source('index.php'); ?>