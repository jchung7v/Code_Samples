<?php
  spl_autoload_register(function($className) {
    require_once("classes/$className.php");
  });

  echo Base::greeting . "<br />";
  echo Derived::greeting . "<br />";
  Derived::func();

?>
<hr />
<?php show_source('classes/Base.php'); ?>
<hr />
<?php show_source('classes/Derived.php'); ?>
<hr />
<?php show_source('index.php'); ?>