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

  interface INumber {
    public function abs();             # :: Number → Number
    public function acos();            # :: Number → Real
    public function acosh();           # :: Number → Real
    public function add($x);           # :: (Number, Number) → Number
    public function asin();            # :: Number → Real
    public function asinh();           # :: Number → Real
    public function atan();            # :: Number → Real
    public function atan2($x);         # :: Number → Real
    public function atanh();           # :: Number → Real
    public function ceil();            # :: Number → Real
    public function cos();             # :: Number → Real
    public function div($x);           # :: (Number, Number) → Number
    public function exp();             # :: Number → Real
    public function floor();           # :: Number → Real
    public function log();             # :: Number → Real
    public function mod($x);           # :: (Number, Number) → Number
    public function mul($x);           # :: (Number, Number) → Number
    public function pow($x);           # :: (Number, Number) → Number
    public function round($x = 0);     # :: Number → Real | (Number, Int) → Real
    public function sin();             # :: Number → Real
    public function sqrt();            # :: Number → Real
    public function sub($x);           # :: (Number, Number) → Number
    public function tan();             # :: Number → Real
  }