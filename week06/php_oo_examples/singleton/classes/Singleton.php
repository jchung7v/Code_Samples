<?php
class Singleton
{
	public $id = 0;
	static private $instance;
	private function __construct()
	{
	}
	private function __clone()
	{
	}
	static function getInstance()
	{
		if (!self::$instance)
			self::$instance = new Singleton();
		return self::$instance;
	}
}
