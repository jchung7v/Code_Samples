<?php
  spl_autoload_register(function($className) {
    require_once("classes/$className.php");
  });

  $a = Singleton::getInstance();
  $a->id = 1;
  $b = Singleton::getInstance();
  print $b->id;
?>
<hr />
<?php show_source('classes/Singleton.php'); ?>
<hr />
<?php show_source('index.php'); ?>