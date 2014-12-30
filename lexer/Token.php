<?php
  
  // Proofing a PHP bug:

  class MagicMethods {
    public function __set($property, $value) {
      var_dump($value);
      echo "/\\ Is the value of {$property}.";
      $this->{$property} = $value;
    }

    public function __unset($property) {
      echo "Unsetting {$property}...";
      unset($this->{$property});
    }
  }

  $obj = new MagicMethods;
  $obj -> type = "T_IDENTIFIER";
  $obj -> text = "Testing";
  $obj -> changeState = function ($self) {

  };

  $obj -> type = "Changing Value...";

  var_dump($obj);
