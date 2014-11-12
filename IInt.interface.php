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

  # Use memoization to store already processed data in a static variable
  # This way you can increase the performance in more than 95% of 
  # already processed data.

  interface IInt {
    public function abs();    # ok - HC
    public function acos();
    public function add($n);  # ok - HC
    public function asin();
    public function atan();
    public function atan2($n);
    public function ceil();
    public function cos();
    public function div($n);
    public function exp();
    public function floor();
    public function log();
    public function mod($n);  # ok - HC
    public function mul($n);  # ok - HC
    public function sub($n);  # ok - HC
    public function pow($n);  # ok - HC
    public function round();
    public function sin();
    public function sqrt();   # ok - HC
    public function tan();
  }