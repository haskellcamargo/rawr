<?php
  require_once "../src/Core/TypeInference.php";
  require_once "../src/DataType/Type.php";
  require_once "../src/DataType/Fun.php";
  require_once "../src/DataType/Fun.php";
  require_once "../src/DataType/Fun.php";

  use \Rawr\DataType\Fun;

  $add = new Fun(function($a, $b)
  {
    return $a + $b;
  });

  $strtoupper = new Fun("strtoupper");


  var_dump("$add");
  var_dump("$strtoupper");