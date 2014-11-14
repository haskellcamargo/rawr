<?php
  class Func extends DataTypes {
    # Implementation of pattern matching
    public function __construct() {
      $arguments = func_get_args();
      $func_length = count($arguments);

      foreach($arguments)
      $func_reflection = new ReflectionFunction($arguments[0]);
    }
  }

  <?php
function foo(Exception $a) { }

$functionReflection = new ReflectionFunction('foo');
$parameters = $functionReflection->getParameters();
$aParameter = $parameters[0];

echo $aParameter->getClass()->name;
?>