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

  # This can receive primitive true and false definitions or instances
  # of TrueClass or FalseClass.
  class Bool extends DataTypes {
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

    public function _and($expr) { # :: (Boolean, Boolean) -> Boolean
      return new Boolean($this->value() && TypeInference :: to_primitive($expr));
    }

    public function _or($expr) { # :: (Boolean, Boolean) -> Boolean
      return new Boolean($this->value() || TypeInference :: to_primitive($expr));
    }

    # The closure passed as parameter is performed if the value of
    # this object is TrueClass.
    public function if_true($clos) { # :: Func -> Boolean
      if ($this->value instanceof TrueClass) 
        $clos();
      return new Boolean($this->value);
    }

    # The closure passed as parameter is performed if the value of
    # this object is FalseClass.
    public function if_false($clos) { # :: Func -> Boolean
      if (!$this->value instanceof FalseClass) 
        $clos();
      return new Boolean($this->value);
    }

    # Negates the value of the object.
    public function not() { # :: Void -> Boolean
      if ($this->value instanceof TrueClass)
        return new Boolean(False);
      elseif ($this->value instanceof FalseClass)
        return new Boolean(True);
    }

    # The same as -> if_true () -> if_false ().
    public function then_else($then, $else) { # :: (Func, Func) -> Boolean
      if ($this->value instanceof TrueClass) 
        $then();
      else 
        $else();
      return new Boolean($this->value);
    }

    # Overrides the method `value` to return the primitive
    # value of the object.
    public function value() { # :: Void -> Boolean
      return $this->value instanceof TrueClass;
    }
  }