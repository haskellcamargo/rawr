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

  # Move to other files

  // namespace TypeClass;


  // # Implement this on Rawr: http://stackoverflow.com/questions/787692/operator-overloading-in-php

  // interface Integral extends Eq {}

  // interface Real {}
  // interface Enum {}

  // interface Eq extends Ord {
  //   function eq(&$a);    # :: (a, a) -> Bool
  //   function diff(&$a);  # :: (a, a) -> Bool
  // }

  // interface Ord {
  //   function compare(&$a); # :: (a, a) -> Ordering
  //   function eq(&$a);      # :: (a, a) -> Bool
  //   function gt(&$a);      # :: (a, a) -> Bool
  //   function gte(&$a);     # :: (a, a) -> Bool
  //   function lt(&$a);      # :: (a, a) -> Bool
  //   function lte(&$a);     # :: (a, a) -> Bool
  //   function max(&$a);     # :: (a, a) -> a
  //   function min(&$a);     # :: (a, a) -> a
  // }

  // interface Show {
  //   function show();     # :: (Show a) => a -> a
  // }

  // define('EQ', 'EQ');
  // define('GT', 'GT');
  // define('LT', 'LT');
  // class Ordering extends DataTypes {}

  namespace TypeClass;

  class Eq implements Contract\IEq {
    function diff($x, $y) { # :: (Eq a) => (a, a) -> bool
      return $x !== $y;
    }

    function eq($x, $y) { # :: (Eq a) => (a, a) -> bool
      return $x === $y;
    }
  }