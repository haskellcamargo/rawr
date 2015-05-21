<?php

namespace Rawr\DataType
{
  use \Exception;
  use \Rawr\Core\TypeInference;
  use \ReflectionFunction;

  class Fun extends Type
  {
    private $reflObj;

    public function __construct($f)
    {
      if (!is_callable($f) && !is_string($f)) {
        throw new Exception;
      }

      $this->value = $f;
      $this->reflObj = new ReflectionFunction($f);
    }

    public function __invoke()
    {
      $arguments = func_get_args();

      if (count($arguments) > 0) {
        return TypeInference::determine(
          call_user_func_array($this->value, $arguments)
        );
      } else {
        return TypeInference::determine(call_user_func($this->value));
      }
    }

    public function invoke()
    {
      return $this();
    }
  }
}