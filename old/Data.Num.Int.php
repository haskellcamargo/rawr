<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-24
  # @package       => Data.Num.Int

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
  use \Data\Str;
  use \Data\Num\Contract\IInt;

  require_once "Data.Num.Contract.IInt.php";

  class Int extends \Data\Num implements IInt {
    public function __construct($v) {
      if (is_numeric($v))
        $this->value = (int) $v;
      else
        throw new Exception("Expecting `{$v}` to be a numeric value. Instead"
          . " got " . gettype($v));
    }

    # Generate a better random value.
    public function mtRandUntil(Int &$n = Null) { # :: (Int, Int) -> Int
      return new Int(
        mt_rand($this->value, $n === Null ? MT_RAND_MAX : $n->value));
    }

    # Seeds the random number generator.
    public function mtSeedRand() { # :: Int -> Int
      mt_srand($this->value);
      return $this;
    }

    # Seeds the random number generator.
    public function seedRand() { # :: Int -> Int
      srand($this->value);
      return $this;
    }

    # Returns a list of integrals
    public function to(Int &$n) { # :: (Int, Int) -> [Int]
      return (new \Data\Collection(range($this->value, $input->value)))
        -> of ('Data.Num.Int');
    }

    # Gives a string containing the binary conversion of the number.
    public function toBin() { # :: Int -> Str
      return new Str(decbin($this->value));
    }

    # Gives a string containing the hexadecimal value of the number.
    public function toHex() { # :: Int -> Str
      return new Str(dechex($this->value));
    }

    # Gives a string containing the octal value of the number.
    public function toOct() { # :: Int -> Str
      return new Str(decoct($this->value));
    }
  }
