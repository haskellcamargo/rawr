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
  header("X-Powered-By: RAWR/1.0.0.2");
  # Typeclasses

  require_once "typeclasses/Eq.interface.php";
  require_once "typeclasses/Ord.interface.php";
  require_once "typeclasses/Eq.php";
  require_once "typeclasses/Ord.php";

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

  require_once 'extras/Constants.php';

  # Types may want to inherit from this class.
  class Datatypes {
    protected $value, $memoize;

    public function __construct() {
      global $memoize;
      $this->memoize   = $memoize;
      return $this;
    }

    public function __toString() { # :: string
      return (string) $this->value;
    }

    public function __call($name, $arguments) { # :: (a, string, array) -> mixed
      array_unshift($arguments, $this);
      return call_user_func_array($this->prototype->{$name}, $arguments);
    }

    public function __clone() { # :: a -> void
      $this->prototype = clone $this->prototype;
    }

    # Equivalent to php's var_dump in the object.
    final public function about() { # :: a -> object
      var_dump($this);
      return $this;
    }

    # Applies a function or a set of instructions of the object
    public function apply($functions) { # :: (a, Str) -> a
      $let = [
        "refl"  =>  new \ReflectionClass(get_class($this))
      , "func"  =>  array_reverse(explode(" . ", $functions))
      ];
      $stack = $this;

      foreach ($let['func'] as $func)
        if ($let['refl'] -> hasMethod($func))
          $stack = (new $let['refl'] -> name ($stack -> value())) -> {$func}();
        else
          throw new \Exception("Object of type {$let['refl'] -> name} has no method {$func}.");

      return $stack;
    }

    # Equivalent to cond or switch
    public function caseOf($of) {
      foreach ($of as $case => $ret)
        if ($this->value == $case)
          return TypeInference :: infer($ret);
      return TypeInference :: infer($of[otherwise]);
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

    # Casting to Bool.
    public function toBool() { # :: a -> String 
      return new Bool($this->value);
    }

    # Casting to Collection.
    public function toCollection() { # :: a -> String
      return new Collection([$this->value]);
    }

    # Casting to Error.
    public function toError() { # :: a -> Error
      return new Error($this->value);
    }

    # Casting to File (path).
    public function toFile() { # :: a -> File
      return new File($this->value);
    }

    # Casting to Func.
    public function toFunc() { # :: a -> Func
      return new Func($this->value);
    }

    # Casting to Null.
    public function toNull() { # :: a -> Null
      return new Null;
    }

    # Casting to Num.
    public function toNum() { # :: a -> Num
      return new Num($this->value);
    }

    # Casting to Float.
    public function toFloat() { # :: a -> Float
      return new Num\Float($this->value);
    }

    # Casting to Int.
    public function toInt() { # :: a -> Int
      return new Num\Int($this->value);
    }

    # Casting to Object.
    public function toObject() { # :: a -> Object
      return new Object($this->value);
    }

    # Casting to String.
    public function toString() { # :: a -> String
      return new Str($this->value);
    }

    # Casting to Undefined (unset value).
    public function toUndefined() { # :: a -> Undefined
      return new Undefined;
    }

    # Casting to Void (return-less).
    public function toVoid() { # :: a -> Void
      return new Void;
    }

    # Replaces backslashes by dots.
    public static function typeName($t) { # :: (a, string) -> string
      return str_replace("\\", ".", $t);
    }

    # Returns the protected value as a php primitive.
    public function value() { # :: a -> a
      return $this->value;
    }
  }