<?php
class Stuff {
	function __construct() {
		echo "object is being created.<br />";
  }
	public function __destruct(){
		echo "object is being destroyed.<br />";
	}
}
?>