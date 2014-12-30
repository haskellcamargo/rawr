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
  use \TypeClass\Eq as Eq;

  final class Void extends DataTypes {
    public function __construct() { # :: a -> a
      unset($this->memoize);
      unset($this->prototype);
      unset($this->value);
    }

    # Different of. Requires all the values to be of the same type
    # and derived from Eq typeclass.
    function diff(Void &$y) { # :: (Eq a) => (a, a) -> Bool
      # Taking account they have no value and the constraint explicit
      # accepts only Data.Void types, this will ALWAYS return false.
      return new Bool(False);
    }

    # Equals to, but requires both values to be of the same type and
    # derived from Eq typeclass.
    function eq(Void &$y) { # :: (Eq a) => (a, a) -> Bool
      # Same note taken to diff, but true.
      return new Bool(True);
    }
  }