<?php

namespace Rawr\Core
{
  use \Rawr\DataType\Decimal;
  use \Rawr\DataType\Int;
  use \Rawr\DataType\String;
  use \Rawr\DataType\Collection;
  use \Rawr\DataType\Fun;

  final class TypeInference
  {
    public static final function determine($value)
    {
      switch (false) {
        case !is_float($value):
          return new Decimal($value);
        case !is_integer($value):
          return new Int($value);
        case !is_string($value):
          return new String($value);
        case !is_array($value):
          return new Collection($value);
        case !is_callable($value):
          return new Fun($value);
        default:
          return $value;
      }
    }
  }
}