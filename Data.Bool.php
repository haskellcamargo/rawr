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
  use \TypeClass\Eq        as Eq;
  use \TypeClass\Ord       as Ord;

  # This can receive primitive true and false.
  class Bool extends DataTypes implements IBool {
    function __construct($val) { # :: a -> Bool
      unset($this->memoize);
      $this->value = (bool) $val;
    }

    # Invokes a function and returns it result.
    private function __behaviour($clos) { # :: Func -> a
      switch (get_class($clos)):
        case 'Closure':     # It's a primitive function
          return $clos();
        case 'Data\Func':   # It's a Rawr defined function
          return $clos->invoke();
        default:
          $let['type'] = gettype($clos);
          throw new Exception("Expected Func or Closure, instead got {$let['type']}.");
      endswitch;
    }

    # Returns true if both the value of the object and of the received
    # expression are true. Otherwise false.
    function _and($expr) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value() && TypeInference :: to_primitive($expr));
    }

    # Returns true if any of the values, of the object, or of the received
    # expression are true. Otherwise false.
    function _or($expr) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value() || TypeInference :: to_primitive($expr));
    }

    # Returns true if only one of the values is true, between
    # the value of the object and the received expression.
    # Otherwise false.
    function _xor($expr) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value() ^ TypeInference :: to_primitive($expr));
    }

    # Different of. Requires all the values to be of the same type
    # and derived from Eq typeclass.
    function diff(Bool $y) { # :: (Eq a) => (a, a) -> Bool
      return new Bool(Eq :: diff($this->value, $y->value()));
    }

    # Equals to, but requires both values to be of the same type and
    # derived from Eq typeclass.
    function eq(Bool $y) { # :: (Eq a) => (a, a) -> Bool
      return new Bool(Eq :: eq($this->value, $y->value()));
    }

    # Returns if the value of this object is greater or equal to
    # the value of received value. Must be derived from Ord typeclass
    # and, obviously, derived from Eq typeclass.
    function greaterOrEq(Bool $y) { # :: (Eq a, Ord a) => (a, a) -> Bool
      return new Bool($this->greaterThan($y) || $this->eq($y));
    }

    # Returns if the value of this object is greater than the received
    # object. Deriving Ord.
    function greaterThan(Bool $y) { # :: (Ord a) => (a, a) -> Bool
      return new Bool(Ord :: GT($this->value, $y->value()));
    }

    # The closure passed as parameter is performed if the value of
    # this object is true.
    function ifTrue($clos) { # :: (Bool, Func) -> Bool
      if ($this->value === true)
        $this->__behaviour($clos);
      return new Bool($this->value);
    }

    # The closure passed as parameter is performed if the value of
    # this object is false.
    function ifFalse($clos) { # :: (Bool, Func) -> Bool
      if ($this->value === false)
        $this->__behaviour($clos);
      return new Bool($this->value);
    }

    # Returns if the value of this object is lesser or equal
    # to the value of the received object. Deriving Ord, Eq.
    function lesserOrEq(Bool $y) { # :: (Eq a, Ord a) => (a, a) -> Bool
      return new Bool($this->lesserThan($y) || $this->eq($y));
    }

    # Returns if the value of this object is lesser than
    # the value of the received object. Deriving Ord.
    function lesserThan(Bool $y) { # :: (Ord a) => (a, a) -> Bool
      return new Bool(Ord :: LT($this->value, $y->value()));
    }

    # Negates the value of the object.
    function not() { # :: Bool -> Bool
      return new Bool(!$this->value);
    }

    # Alias to ifFalse.
    function otherwise($clos) { # :: (Bool, Func) -> Bool
      return $this->if_false($clos);
    }

    # The same as -> ifTrue () -> iFalse ().
    function thenElse($then, $else) { # :: (Bool, Func, Func) -> Bool
      if ($this->value === true)
        $this->__behaviour($then);
      else
        $this->__behaviour($else);
      return new Bool($this->value);
    }
  }