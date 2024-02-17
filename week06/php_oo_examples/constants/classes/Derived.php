<?php
require_once('Derived.php');

class Derived extends Base {
	const greeting ="Hello from Derived<br />";
	static function func() {
		echo parent::greeting;
	}
}
?>