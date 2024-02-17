<?php
require_once('Base.php');

class Stuff extends Base {
	public static function What() {
		self::Show();
		parent::Show();
	}
	public static function Show() {
		echo __FILE__.'('.__LINE__.'):'.__METHOD__."<br />";
	}
}
?>