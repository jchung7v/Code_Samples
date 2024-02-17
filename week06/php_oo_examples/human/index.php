<?php
  spl_autoload_register(function($className) {
    require_once("classes/$className.php");
  });

  // new object has data passed to it
  $human = new Human("John Doe");
  echo $human->getName();
?>
<hr />
<?php show_source('classes/Human.php'); ?>
<hr />
<?php show_source('index.php'); ?>
