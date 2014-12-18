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

  namespace Data\Contract;
  use \Data\Bool as Bool;

  interface IBool {
    function __construct($val);                 # :: a -> Bool
    function _and($expr);                       # :: (Bool, Bool) -> Bool
    function _or($expr);                        # :: (Bool, Bool) -> Bool
    function _xor($expr);                       # :: (Bool, Bool) -> Bool
    function diff(Bool $expr);                  # :: (Eq a) => (a, a) -> Bool
    function eq(Bool $expr);                    # :: (Eq a) => (a, a) -> Bool
    function greaterOrEq(Bool $expr);           # :: (Eq a, Ord a) => (a, a) -> Bool
    function greaterThan(Bool $expr);           # :: (Ord a) => (a, a) -> Bool
    function ifTrue($do);                       # :: (Bool, Func) -> Bool
    function ifFalse($do);                      # :: (Bool, Func) -> Bool
    function lesserThan(Bool $expr);            # :: (Ord a) => (a, a) -> Bool
    function not();                             # :: Bool -> Bool
    function otherwise($do);                    # :: (Bool, Func) -> Bool
    function thenElse($x, $y);                  # :: (Bool, Func, Func) -> Bool
  }