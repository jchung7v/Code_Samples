<?php
require_once('Human.php');

class Woman extends Human{
  private $_name;
  public function __construct($name) { $this->_name = $name; }
	final public function gender() { return 'female'; }
	public function giveBirth() { /*...*/ }
}
?>