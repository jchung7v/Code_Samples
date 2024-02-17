<?php
  class Stuff {
    static $stat ="Hello\n";
    static function test() {
      echo self::$stat;
    }
  }
?>