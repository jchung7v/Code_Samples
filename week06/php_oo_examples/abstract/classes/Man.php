<?php
require_once('Human.php');
class Man extends Human{
  private $_name;
  public function __construct($name) { $this->_name = $name; }
	final public function gender() { return 'male'; }
	public function snore() { /*...*/ }
}
?>