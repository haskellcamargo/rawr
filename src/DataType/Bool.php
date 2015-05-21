<?php

namespace Rawr\DataType
{
  class Bool extends Type
  {
    public function __construct($value)
    {
      $this->value = (bool) $value;
    }

    public function _and(Bool &$b)
    {
      return new Bool($this->value && $b->value);
    }

    public function _or(Bool &$b)
    {
      return new Bool($this->value || $b->value);
    }

    public function diff(Bool &$b)
    {
      return new Bool($this->value !== $b->value);
    }

    public function eq(Bool &$b)
    {
      return new Bool($this->value === $b->value);
    }

    public function gt(Bool &$b)
    {
      return new Bool($this->value > $b->value);
    }

    public function gtOrEq(Bool &$b)
    {
      return new Bool($this->value >= $b->value);
    }

    public function ifTrue(Fun &$f)
    {
      if ($this->value) {
        $f->invoke();
      }
      return $this;
    }

    public function ifFalse(Fun &$f)
    {
      if (!$this->value) {
        $f->invoke();
      }
      return $this;
    }

    public function lt(Bool &$b)
    {
      return new Bool($this->value < $b->value);
    }

    public function ltOrEq(Bool &$b)
    {
      return new Bool($this->value <= $b->value);
    }

    public function not()
    {
      return new Bool(!$this->value);
    }

    public function otherwise(Fun &$f)
    {
      return $this->ifFalse($f);
    }

    public function thenElse($f, $g)
    {
      return $this->value
        ? $f
        : $g;
    }
  }
}
