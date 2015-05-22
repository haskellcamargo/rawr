<?php

namespace Rawr\DataType
{
  /**
   * @package Rawr
   * @version 1.4.0.0
   */
  class Bool extends Type
  {
    /**
     * Receives any value and casts it to a Bool.
     * @author Marcelo Camargo
     * @param mixed $value
     * @return Bool
     */
    public function __construct($value)
    {
      $this->value = (bool) $value;
    }

    /**
     * Logical and. Both values must be true.
     * @author Marcelo Camargo
     * @param Bool $b
     * @return Bool
     */
    public function _and(Bool &$b)
    {
      return new Bool($this->value && $b->value);
    }

    /**
     * Logical or. At least one of the values must be true.
     * @author Marcelo Camargo
     * @param Bool $b
     * @return Bool
     */
    public function _or(Bool &$b)
    {
      return new Bool($this->value || $b->value);
    }

    /**
     * Different of. Returns true if the values are not the same.
     * @author Marcelo Camargo
     * @param Bool $b
     * @return Bool
     */
    public function diff(Bool &$b)
    {
      return new Bool($this->value !== $b->value);
    }

    /**
     * Equality. Both values must be equal.
     * @author Marcelo Camargo
     * @param Bool $b
     * @return Bool
     */
    public function eq(Bool &$b)
    {
      return new Bool($this->value === $b->value);
    }

    /**
     * Greater than.
     * @author Marcelo Camargo
     * @param Bool $b
     * @return Bool
     */
    public function gt(Bool &$b)
    {
      return new Bool($this->value > $b->value);
    }

    /**
     * Greater or equal.
     * @author Marcelo Camargo
     * @param Bool $b
     * @return Bool
     */
    public function gtOrEq(Bool &$b)
    {
      return new Bool($this->value >= $b->value);
    }

    /**
     * Applies a function if value is truthy.
     * @author Marcelo Camargo
     * @param mixed $f The function to be applied (string, Closure, Fun)
     * @return Bool
     */
    public function ifTrue(Fun &$f)
    {
      TypeInference::assertCallable($f);
      if ($this->value) {
        $f->invoke();
      }
      return $this;
    }

    /**
     * Applies a function if value is not truthy.
     * @author Marcelo Camargo
     * @param mixed $f The function to be applied (string, Closure, Fun)
     * @return Bool
     */
    public function ifFalse(Fun &$f)
    {
      TypeInference::assertCallable($f);
      if (!$this->value) {
        $f->invoke();
      }
      return $this;
    }

    /**
     * Lesser than.
     * @author Marcelo Camargo
     * @param Bool $b
     * @return Bool
     */
    public function lt(Bool &$b)
    {
      return new Bool($this->value < $b->value);
    }

    /**
     * Lesser or equal.
     * @author Marcelo Camargo
     * @param Bool $b
     * @return Bool
     */
    public function ltOrEq(Bool &$b)
    {
      return new Bool($this->value <= $b->value);
    }

    /**
     * Negates a boolean value.
     * @author Marcelo Camargo
     * @return Bool
     */
    public function not()
    {
      return new Bool(!$this->value);
    }

    /**
     * Alias to ifFalse.
     * @author Marcelo camargo
     * @param Fun $f
     * @return Data.Bool
     */
    public function otherwise(Fun &$f)
    {
      return $this->ifFalse($f);
    }

    /**
     * Ternary method. Equivalent to `expr ? left : right`.
     * @author Marcelo Camargo
     * @param mixed $left
     * @param mixed $right
     * @return mixed
     */
    public function thenElse($left, $right)
    {
      return $this->value
        ? $left
        : $right;
    }
  }
}
