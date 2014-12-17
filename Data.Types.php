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

  # Typeclasses

  require_once "typeclasses/Eq.interface.php";
  require_once "typeclasses/Ord.interface.php";
  require_once "typeclasses/Eq.php";
  require_once "typeclasses/Ord.php";

  # Boolean

  require_once 'Data.Error.php';

  require_once 'Data.Bool.php';

  # If you don't want the entire world to burn down in flames, DON'T REMOVE THIS INCLUSION:
  require_once 'typing/TypeInference.class.php';
  
  # Parent class for numeric types
  require_once 'Data.Num.php';
  require_once 'Data.Collection.php';
  require_once 'Data.Func.php';
  require_once 'Data.Num.Int.php';
  require_once 'Data.Object.php';
  require_once 'Data.Num.Float.php';
  require_once 'Data.Str.php';
  require_once 'Data.Undefined.php';
  require_once 'Data.Void.php';
  
  require_once 'Extras/Shortcuts.php';
  require_once 'Modules/Memoize.class.php';
  require_once 'prototype/Prototype.class.php';
  require_once 'prototype/Define.class.php';

  require_once 'extras/Constants.php';

  # Types may want to inherit from this class.
  class Datatypes {
    protected $value, $memoize;
    public $prototype = null;

    public function __construct() {
      global $memoize;
      $this->memoize   = $memoize;
      $this->prototype = new Define;
      return $this;
    }

    public function __toString() { # :: string
      return (string) $this->value;
    }

    public function __call($name, $arguments) { # :: (string, array) -> mixed
      array_unshift($arguments, $this);
      return call_user_func_array($this->prototype->{$name}, $arguments);
    }

    public function __clone() { # :: void
      $this->prototype = clone $this->prototype;
    }

    public static function type_name($t) { # :: string -> string
      return str_replace("\\", ".", $t);
    }

    # Equivalent to php's var_dump in the object.
    public function about() { # :: object
      var_dump($this);
      return $this;
    }

    # Returns the element by itself.
    public function id() { # :: a -> a
      return $this;
    }

    # Equivalent to php's var_dump.
    public function inspect() { # :: object
      var_dump($this->value);
      return $this;
    }

    # Casting to string
    public function to_string() { # :: String
      return new Str($this->value);
    }

    # Returns the protected value as a php primitive.
    public function value() { # :: a
      return $this->value;
    }
  }