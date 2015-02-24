<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-25
  # @package       => Data.Bool

  # Copyright (c) 2014 Marcelo Camargo <marcelocamargo@linuxmail.org>
  #
  # Permission is hereby granted, free of charge, to any person
  # obtaining a copy of this software and associated documentation files
  # (the "Software"), to deal in the Software without restriction,
  # including without limitation the rights to use, copy, modify, merge,
  # publish, distribute, sublicense, and/or sell copies of the Software,
  # and to permit persons to whom the Software is furnished to do so,
  # subject to the following conditions:
  #
  # The above copyright notice and this permission notice shall be
  # included in all copies or substantial of portions the Software.
  #
  # THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  # EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  # MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  # NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
  # LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
  # OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
  # WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

  namespace Data;

  require_once 'Data.Contract.IBool.php';
  use \Data\Contract\IBool as IBool;

  # A `Bool` type can hold two primitive values: `True` and `False`. When
  # starting designing Rawr, we decided to use `True` and `False` as
  # constructors, in a Haskell-like way, but we would have great troubles with performance and capabilities, as much as simple logic-values would be an object, an instance of a class.
  class Bool extends DataTypes implements IBool {
    function __construct($val) { # :: a -> Bool
      unset($this->memoize);
      $this->value = (bool) $val;
    }

    # Returns `Bool (True)` if both the value of the object and the value of the
    # received expression are true. Otherwise, false.
    function _and(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value && $b());
    }

    # Returns `Bool (True)` if any of the values, of the object, or of the
    # received expression, are true. Otherwise, false.
    function _or(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value || $b());
    }

    # Comparison of the difference of two objects or values of *same* type.
    function diff(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value !== $b());
    }

    # Comparison of the equality of two objects or values of *same* type.
    function eq(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value === $b());
    }

    # Returns if the value of this object is greater or equal to the received
    # value.
    function greaterOrEq(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value >= $b());
    }

    # Returns if the value of this object is greater than the received value.
    function greaterThan(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value > $b());
    }

    # The closure passed as parameter is called if the value of this object is
    # `Bool (True)`. After, it returns the value by itself to allow
    # method-chaining.
    function ifTrue(Func &$f) { # :: (Bool, Func) -> Bool
      if ($this->value === true) # Strict-comparison.
        $f();
      return new Bool($this->value);
    }

    # The closure passed as parameter is called if the value of this object is
    # `Bool (False)`. After, it returns the value by itself to allow
    # method-chaining.
    function ifFalse(Func &$f) { # :: (Bool, Func) -> Bool
      if ($this->value === false)
        $clos();
      return new Bool($this->value);
    }

    # Returns if the value of this object is lesser or equal to the received
    # value.
    function lesserOrEq(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value <= $b());
    }

    # Returns if the value of this object is lesser than the received value.
    function lesserThan(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value < $b());
    }

    # Reverses the value of a boolean object.
    function not() { # :: Bool -> Bool
      return new Bool(!$this->value);
    }

    # Alias to `ifFalse`.
    function otherwise(Func &$clos) { # :: (Bool, Func) -> Bool
      return $this->ifFalse($clos);
    }

    # Equivalent to `ifTrue` and `ifFalse`.
    function thenElse(Func &$t, Func &$e) { # :: (Bool, Func, Func) -> Bool
      if ($this->value === true)
        $t();
      else
        $e();
      return new Bool($this->value);
    }
  }
