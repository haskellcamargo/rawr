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

  require_once 'INumber.interface.php';

  # Parent class for Real and Int.
  # This class knows how to choose between the types according
  # to the correct occasion.
  # Numeric types might extend it.

  class Number extends DataTypes {

    # This method is responsible by, if the variable already is type X, 
    # cast the variable to Y, by returning a new Y. Otherwise change its
    # inner value.
    private function as_real_do($closure, $aux = null) { # (Func, Maybe Float) -> Float
       if (get_class($this) === "Real") {
        $this->value = $aux === null?
          $closure($this->value)
        : $closure($this->value, $aux);
        return $this;
       } else return $aux === null?
          new Real($closure($this->value))
        : new Real($closure($this->value, $aux));
    }

    public function __construct($val) { # a -> a
      # We expect $val to be a numeric value.
      if (is_numeric($val))
        $this->value = $val;
      else throw new Exception("Expecting `{$val}` to be a valid number. Received " . gettype($val));
      return $this;
    }

    # Absolute value.
    public function abs() { # a -> Number
      $this->value = abs($this->value);
      return $this;
    }

    # Arc cosin.
    public function arc_cos() { # Float -> Float
      return $this
        -> as_real_do('acos');
    }

    # Hyperbolic arc cosin,
    public function h_arc_cos() { # Float -> Float
      return $this
        -> as_real_do('acosh');
    }

    # Adds $value to the number.
    public function add($value) { # (Float, Float) -> Float
      $this->value += TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Arc sin.
    public function arc_sin() { # Float -> Float
      return $this
        -> as_real_do('asin');
    }

    # Hyperbolic arc sin.
    public function h_arc_sin() { # Float -> Float
      return $this
        -> as_real_do('asinh');
    }

    # Arc tangent.
    public function atan() { # Float -> Float
      return $this
        -> as_real_do('atan');
    }

    # Number -> Real
    public function atan2($input) {
      return $this
        -> as_real_do('atan2', 
          TypeInference :: to_primitive($input));
    }

    # Number -> Real
    public function atanh() {
      return $this
        -> as_real_do('atanh');
    }

    # Number -> Real
    public function ceil() {
      return $this
        -> as_real_do('ceil');
    }

    # Number -> Real
    public function cos() {
      return $this
        -> as_real_do('cos');
    }

    # Number -> Real
    public function deg_to_rad() {
      return $this
        -> as_real_do('deg2rad');
    }

    # (Number, Number) -> Number
    public function div($value) {
      $this->value /= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Number -> Real
    public function exp() {
      return $this
        -> as_real_do('exp');
    }

    # Number -> Real
    public function expm1() {
      return $this
        -> as_real_do('expm1');
    }

    # Number -> Real
    public function floor() {
      return $this
        -> as_real_do('floor');
    }

    # Number -> Real
    public function log() {
      return $this
        -> as_real_do('log');
    }

    # (Number, Number) -> Number 
    public function mod($value) {
      // PHP, someday you will yet be punished by force me this conditional
      // and by the non-implementation of operator overloading in module operator. 
      // This day will come. Wait for it!
      if (get_class($value) === "Real")
        $this->value = fmod($this->value, TypeInference :: to_primitive($value));
      else 
        $this->value = $this->value % TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # (Number -> Number) -> Number
    public function mul($value) {
      $this->value *= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # (Number, Number) -> Number
    public function pow($exp) {
      $this->value = pow($this->value, TypeInference :: to_primitive($exp));
      return TypeInference :: infer($this);
    }

    # Number -> Real
    # (Number, Int) -> Real
    public function round($precision = 0) {
      return $this
        -> as_real_do('round',
          TypeInference :: to_primitive($precision));
    }

    # Number -> Real
    public function sin() {
      return $this
        -> as_real_do('sin');
    }

    # Number -> Real
    public function sqrt() {
      return new Real(sqrt($this->value));
    }

    # (Number, Number) -> Number
    public function sub($value) {
      $this->value -= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Number -> Real
    public function tan() {
      return $this
        -> as_real_do('tan');
    }
  }