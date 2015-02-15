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

  # Side effect functions must return themselves.

  namespace Data\Num;
  use \Data\Str;

  require_once "Data.Num.Contract.IInt.php";
  use \Data\Num\Contract\IInt;

  class Int extends \Data\Num implements IInt {
    public function __construct($i) { # :: a -> a
      parent :: __construct((int) $i);
    }

    # Generate a better random value.
    public function mtRandUntil(Int &$n = Null) { # :: (Int, Int) -> Int
      return new Int(
        mt_rand($this(), $n === Null ? MT_RAND_MAX : $n()));
    }

    # Seeds the random number generator.
    public function mtSeedRand() { # :: Int -> Int
      mt_srand($this());
      return $this;
    }

    # Seeds the random number generator.
    public function seedRand() { # :: Int -> Int
      srand($this());
      return $this;
    }

    # Returns a list of integrals
    public function to(Int &$n) { # :: (Int, Int) -> [Int]
      return (new \Data\Collection(range($this(), $input())))
        -> of ('Data.Num.Int');
    }

    # Gives a string containing the binary conversion of the number.
    public function toBin() { # :: Int -> Str
      return new Str(decbin($this()));
    }

    # Gives a string containing the hexadecimal value of the number.
    public function toHex() { # :: Int -> Str
      return new Str(dechex($this()));
    }

    # Gives a string containing the octal value of the number.
    public function toOct() { # :: Int -> Str
      return new Str(decoct($this()));
    }
  }