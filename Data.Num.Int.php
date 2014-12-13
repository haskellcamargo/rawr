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

  namespace Data\Num;

  require_once "Data.Num.Contract.IInt.php";
  use \Data\Num\Contract\IInt as IInt;
  use \TypeClass\Eq           as Eq;

  class Int extends \Data\Num implements IInt {
    public function __construct($i) { # :: a -> a
      parent :: __construct((int) $i);
    }

    public function diff(Int $y) { # :: (Eq a) => (Int, Int) -> bool
      return new \Data\Bool(Eq :: diff($this->value, $y->value()));
    }

    public function eq(Int $y) { # :: (Eq a) => (Int, Int) -> bool
      return new \Data\Bool(Eq :: eq($this->value, $y->value())); 
    }

    # Returns a list of integrals
    public function to($input) { # :: (Int, Int) -> [Int]
      return (new \Data\Collection(range($this->value, \Data\TypeInference :: to_primitive($input))))
        -> of ('Data.Num.Int');
    }
  }