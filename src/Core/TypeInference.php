<?php

namespace Rawr\Core
{
  use \Exception;
  use \Rawr\DataType\Decimal;
  use \Rawr\DataType\Int;
  use \Rawr\DataType\String;
  use \Rawr\DataType\Collection;
  use \Rawr\DataType\Fun;

  final class TypeInference
  {
    public static function assertCallable($value)
    {
      if (!is_callable($value))
        throw new Exception;
    }

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

    public static function toPrimitive(&$var)
    {
      if (is_object($var)) {
        if (method_exists(get_class($var), "value")) {
          return $var->value();
        }
        return null;
      }
      return $var;
    }
  }
}