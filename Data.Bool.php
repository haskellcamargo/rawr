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

  # This can receive primitive true and false definitions or instances
  # of TrueClass or FalseClass.
  class Bool extends DataTypes implements IBool {
    public function __construct($val) { # :: a -> Bool
      unset($this->memoize);
      $this->value = (bool) $val;
    }

    private function __behaviour($clos) { # :: Func -> a
      switch (get_class($clos)) {
        case 'Closure':
          return $clos();
        case 'Data\Func':
          return $clos->invoke();
      }
    }

    public function _and($expr) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value() && TypeInference :: to_primitive($expr));
    }

    public function _or($expr) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value() || TypeInference :: to_primitive($expr));
    }

    public function _xor($expr) { # :: (Bool, Bool) -> Bool
      return new Bool($this->value() ^ TypeInference :: to_primitive($expr));
    }

    public function diff(Bool $y) { # :: (Eq) => (Bool, Bool) -> Bool
      return new Bool(Eq :: diff($this->value, $y->value()));
    }

    public function eq(Bool $y) { # :: (Eq) => (Bool, Bool) -> Bool
      return new Bool(Eq :: eq($this->value, $y->value())); 
    }

    public function greaterOrEq(Bool $y) { # :: (Eq, Ord) => (Bool, Bool) -> Bool
      return new Bool($this->greaterThan($y) || $this->eq($y));
    }

    public function greaterThan(Bool $y) { # :: (Ord) => (Bool, Bool) -> Bool
      return new Bool(Ord :: GT($this->value, $y->value()));
    }

    # The closure passed as parameter is performed if the value of
    # this object is TrueClass.
    public function ifTrue($clos) { # :: Func -> Bool
      if ($this->value === true)
        $this->__behaviour($clos);
      return new Bool($this->value);
    }

    # The closure passed as parameter is performed if the value of
    # this object is FalseClass.
    public function ifFalse($clos) { # :: Func -> Bool
      if ($this->value === false)
        $this->__behaviour($clos);
      return new Bool($this->value);
    }

    public function lesserThan(Bool $y) { # :: (Ord) => (Bool, Bool) -> Bool
      return new Bool(Ord :: LT($this->value, $y->value()));
    }

    # Negates the value of the object.
    public function not() { # :: Void -> Bool
      return new Bool(!$this->value);
    }

    # Alias to if_false
    public function otherwise($clos) { # :: Func -> Bool
      return $this->if_false($clos);
    }

    # The same as -> if_true () -> if_false ().
    public function thenElse($then, $else) { # :: (Func, Func) -> Bool
      if ($this->value === true)
        $then();
      else 
        $else();
      return new Bool($this->value);
    }
  }