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

  require_once 'Data.Error.php';

  require_once 'Data.Bool.php';
  require_once 'Data.Bool.FalseClass.php';
  require_once 'Data.Bool.TrueClass.php';

  # If you don't want the entire world to burn down in flames, DON'T REMOVE THIS INCLUSION:
  require_once 'typing/TypeInference.class.php';
  
  # Parent class for numeric types
  require_once 'Data.Num.php';
  require_once 'Data.Byte.php';
  require_once 'Data.Char.php';
  require_once 'Data.Collection.php';
  require_once 'Data.Either.php';
  require_once 'Data.Func.php';
  require_once 'Data.Num.Int.php';
  require_once 'Data.Object.php';
  require_once 'Data.Num.Float.php';
  require_once 'Data.Str.php';
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

    public function __call($name, $arguments) {
      array_unshift($arguments, $this);
      return call_user_func_array($this->prototype->{$name}, $arguments);
    }

    public function __clone() {
      $this->prototype = clone $this->prototype;
    }

    # Equivalent to php's var_dump in the object.
    # a → Void
    public function about() {
      var_dump($this);
      return $this;
    }

    # Compares two variables and its types.
    # Mixed → Boolean
    public function equals($var) {
      
    }

    # Returns the element by itself.
    # Mixed → Mixed
    public function id() {
      return $this;
    }

    # Equivalent to php's var_dump.
    # Mixed → Void
    public function inspect() {
      var_dump($this->value);
      return $this;
    }

    # Returns the protected value as a php primitive.
    # Mixed → Mixed
    public function value() {
      return $this->value;
    }

    # Casts to Binary.
    # Mixed → Binary
    public function to_binary() {
      return new Binary($this->value);
    }

    # Casts to Boolean.
    # Mixed → Boolean
    public function to_boolean() {
      return new Boolean($this->value);
    }

    # Casts to Byte.
    # Mixed → Byte
    public function to_byte() {
      return new Byte($this->value);
    }

    # Casts to Char.
    # Mixed → Char
    public function to_char() {
      return new Char($this->value);
    }

    # Casts to Either.
    # Mixed → Either
    public function to_either() {
      return new Either($this->value);
    }

    # Casts to Func.
    # Mixed → Func
    public function to_func() {
      return new Func($this->value);
    }

    # Casts to Integer.
    # Mixed → Integer
    public function to_int() {
      return new Int($this->value);
    }

    # Casts to Object.
    # Mixed → Object
    public function to_object() {
      return new Object($this->value);
    }

    # Casts to Real.
    # Mixed → Real
    public function to_real() {
      return new Real($this->value);
    }

    # Casts to String.
    # Mixed → String
    public function to_string() {
      return new Str($this->value);
    }
  }