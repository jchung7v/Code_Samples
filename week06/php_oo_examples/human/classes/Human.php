<?php
  class Human {
    private $_name;
    public function __construct($newHumansName) {
      if ((!is_string($newHumansName)) || 
        (strlen($newHumansName)==0)){
          throw new Exception('Illegal name');
      }
      $this->_name = $newHumansName;
      echo "new Human object, name $this->_name<br />";
    }
    public function getName(){
      return $this->_name;
    }
  }
?>