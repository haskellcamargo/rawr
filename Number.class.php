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

  class Number extends DataTypes implements INumber {

    private function __do__($closure, $aux = null) {
       if (get_class($this) === "Real") {
        $this->value = $aux === null?
          $closure($this->value)
        : $closure($this->value, $aux);
        return $this;
       } else return $aux === null?
          new Real($closure($this->value))
        : new Real($closure($this->value, $aux));
    }

    public function __construct($val) {
      if (is_numeric($val))
        $this->value = $val;
      else throw new Exception("Expecting `{$val}` to be a valid number. Received " . gettype($val));
      return $this;
    }

    # Number → Number
    public function abs() {
      $this->value = abs($this->value);
      return $this;
    }

    # Number → Real
    public function acos() {
      return $this
        -> __do__('acos');
    }

    # Number → Real
    public function acosh() {
      return $this
        -> __do__('acosh');
    }

    # (Number, Number) → Number
    public function add($value) {
      $this->value += TypeInference :: to_primitive($value);
      return TypeInference :: infer($this->value);
    }

    # Number → Real
    public function asin() {
      return $this
        -> __do__('asin');
    }

    # Number → Real
    public function asinh() {
      return $this
        -> __do__('asinh');
    }

    # Number → Real
    public function atan() {
      return $this
        -> __do__('atan');
    }

    # Number → Real
    public function atan2($input) {
      return $this
        -> __do__('atan2', 
          TypeInference :: to_primitive($input));
    }

    # Number → Real
    public function atanh() {
      return $this
        -> __do__('atanh');
    }

    # Number → Real
    public function ceil() {
      return $this
        -> __do__('ceil');
    }

    # Number → Real
    public function cos() {
      return $this
        -> __do__('cos');
    }

    # (Number, Number) → Number
    public function div($value) {
      $this->value /= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Number → Real
    public function exp() {
      return $this
        -> __do__('exp');
    }

    # Number → Real
    public function floor() {
      return $this
        -> __do__('floor');
    }

    # Number → Real
    public function log() {
      return $this
        -> __do__('log');
    }

    # (Number, Number) → Number 
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

    # (Number → Number) → Number
    public function mul($value) {
      $this->value *= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # (Number, Number) → Number
    public function pow($exp) {
      $this->value = pow($this->value, TypeInference :: to_primitive($exp));
      return TypeInference :: infer($this);
    }

    # Number → Real
    # (Number, Int) → Real
    public function round($precision = 0) {
      return $this
        -> __do__('round',
          TypeInference :: to_primitive($precision));
    }

    # Number → Real
    public function sin() {
      return $this
        -> __do__('sin');
    }

    # Number → Real
    public function sqrt() {
      return new Real(sqrt($this->value));
    }

    # (Number, Number) → Number
    public function sub($value) {
      $this->value -= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Number → Real
    public function tan() {
      return $this
        -> __do__('tan');
    }
  }