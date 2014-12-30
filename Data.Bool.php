<?php
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

  # This can receive primitive true and false.
  class Bool extends DataTypes implements IBool {
    function __construct($val) { # :: a -> Bool
      unset($this->memoize);
      $this->value = (bool) $val;
    }

    # Returns true if both the value of the object and of the received
    # expression are true. Otherwise false.
    function _and(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this() && $b());
    }

    # Returns true if any of the values, of the object, or of the received
    # expression are true. Otherwise false.
    function _or(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this() || $b());
    }

    # Different of.
    function diff(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this() !== $b());
    }

    # Equals to.
    function eq(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this() === $b());
    }

    # Returns if the value of this object is greater or equal to
    # the value of received value.
    function greaterOrEq(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this() >= $b());
    }

    # Returns if the value of this object is greater than the received
    # object.
    function greaterThan(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this() > $b());
    }

    # The closure passed as parameter is performed if the value of
    # this object is true.
    function ifTrue(Func &$f) { # :: (Bool, Func) -> Bool
      if ($this() === true) # Strict-comparison.
        $f();
      return new Bool($this());
    }

    # The closure passed as parameter is performed if the value of
    # this object is false.
    function ifFalse(Func &$f) { # :: (Bool, Func) -> Bool
      if ($this->value === false)
        $clos();
      return new Bool($this());
    }

    # Returns if the value of this object is lesser or equal
    # to the value of the received object. Deriving Ord, Eq.
    function lesserOrEq(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this() <= $b());
    }

    # Returns if the value of this object is lesser than
    # the value of the received object.
    function lesserThan(Bool &$b) { # :: (Bool, Bool) -> Bool
      return new Bool($this() < $b());
    }

    # Negates the value of the object.
    function not() { # :: Bool -> Bool
      return new Bool(!$this());
    }

    # Alias to ifFalse.
    function otherwise(Func &$clos) { # :: (Bool, Func) -> Bool
      return $this->ifFalse($clos);
    }

    # The same as -> ifTrue () -> iFalse ().
    function thenElse(Func &$t, Func &$e) { # :: (Bool, Func, Func) -> Bool
      if ($this() === true)
        $t();
      else
        $e();
      return new Bool($this());
    }
  }