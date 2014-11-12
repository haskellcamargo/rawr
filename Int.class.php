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

  require_once "IInt.interface.php";

  class Int extends DataTypes {
    # Mixed → Void
    public function __construct($i) {
      $this->value = (int) $i;
      return $this;
    }

    # Integer → Integer
    public function abs() {
      $this->value = abs($this->value);
      return $this;
    }

    # Integer → Integer, Real → Integer, Real
    public function add($value) {
      $this->value += $value;
      return type_inference();
    }

    # Integer → Number → Number
    public function div($value) {
      $this->value /= $value;
      return $this;
    }

    # Integer → Number → Number
    public function mod($value) {
      $this->value %= $value;
      return $this;
    }

    # Integer → Number → Number
    public function mul($value) {
      $this->value *= $value;
      return $this;
    }

    # Integer → Integer → Integer
    public function pow($to) {
      $this->value = pow($this->value, $to);
      return $this;
    }

    # Integer → Number → Number
    public function sub($value) {
      $this->value -= $value;
      return $this;
    }

    # Integer → Number
    public function sqrt() {
      $this->value = new Float(sqrt($this->value));
      return $this;
    }   
  }