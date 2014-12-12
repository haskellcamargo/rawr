<?php
  # Copyright (c) 2014 Haskell Camargo <haskell@linuxmail.org>
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
  use \Data\Bool\TrueClass  as TrueClass;
  use \Data\Bool\FalseClass as FalseClass;

  require_once 'Data.Contract.IBool.php';

  # This can receive primitive true and false definitions or instances
  # of TrueClass or FalseClass.
  class Bool extends DataTypes implements Contract\IBool {
    public function __construct($val) { # :: a -> a
      # Memoization isn't very useful here.
      unset($this->memoize);
      # Keep value if they are objects and instances of FalseClass or
      # TrueClass.
      if ($val instanceof TrueClass || $val instanceof FalseClass)
        $this->value = $val;
      else
      # Cast (true, false) => (TrueClass, FalseClass);
        $this->value = ($val === true) ? (new TrueClass) : (new FalseClass);
      return $this;
    }

    private function __behaviour($clos) { # :: Func -> Void
      switch (get_class($clos)) {
        case 'Closure':
          $clos();
          break;
        case 'Data\Func':
          $clos->invoke();
          break;
      }
      return Void;
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

    # The closure passed as parameter is performed if the value of
    # this object is TrueClass.
    public function if_true($clos) { # :: Func -> Bool
      if ($this->value instanceof TrueClass)
        $this->__behaviour($clos);
      return new Bool($this->value);
    }

    # The closure passed as parameter is performed if the value of
    # this object is FalseClass.
    public function if_false($clos) { # :: Func -> Bool
      if ($this->value instanceof FalseClass)
        $this->__behaviour($clos);
      return new Bool($this->value);
    }

    # Negates the value of the object.
    public function not() { # :: Void -> Bool
      if ($this->value instanceof TrueClass)
        return new Bool(False);
      elseif ($this->value instanceof FalseClass)
        return new Bool(True);
    }

    # Alias to if_false
    public function otherwise($clos) { # :: Func -> Bool
      return $this->if_false($clos);
    }

    # The same as -> if_true () -> if_false ().
    public function then_else($then, $else) { # :: (Func, Func) -> Bool
      if ($this->value instanceof TrueClass) 
        $then();
      else 
        $else();
      return new Bool($this->value);
    }

    # Overrides the method `value` to return the primitive
    # value of the object.
    public function value() { # :: Void -> Bool
      return $this->value instanceof TrueClass;
    }
  }