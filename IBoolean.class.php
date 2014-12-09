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

  interface IBoolean {
    public function __construct($val);                 # :: a -> a
    public function _and($x);                          # :: Boolean -> Boolean
    public function _or($x);                           # :: Boolean -> Boolean
    public function _xor($x);                          # :: Boolean -> Boolean
    public function if_true($x);                       # :: Func -> Boolean
    public function if_false($x);                      # :: Func -> Boolean
    public function not();                             # :: Void -> Boolean
    public function then_else($x, $y);                 # :: (Func, Func) -> Boolean
    public function value();                           # :: Void -> Boolean
  }