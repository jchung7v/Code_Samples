<?php
  spl_autoload_register(function($className) {
    require_once("classes/$className.php");
  });

  $simple = new Simple(); 
  $simple->introduceSelf();
?>
<hr />
<?php show_source('classes/Simple.php'); ?>
<hr />
<?php show_source('index.php'); ?>
