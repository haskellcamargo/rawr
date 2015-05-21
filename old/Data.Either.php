<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-24
  # @package       => Data.Either

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

  require_once 'Data.Contract.IEither.php';
  require_once 'Data.Either.Left.php';
  require_once 'Data.Either.Right.php';

  # The `Either` type represents values with two possibilities: a value of type
  # `Either a b` is either `Left a` or `Right b`.
  # The `Either` type is sometimes used to represent a value which is either
  # correct or an error; by convention, the `Left` constructor is used to hold
  # an error value and the `Right` constructor is used to hold a correct value
  # (mnemonic: "right" also means "correct").
  abstract class Either extends DataTypes {
    # Case analysis for the `Either` type. If the value is `Left a`, apply the
    # first function to a; if it is `Right b`, apply the second function to b.
    abstract function either($f, $g); # :: (Either a b, Func, Func) -> c

    # Return `Bool (True)` if the given value is a `Left`-value, `Bool (False)`
    # otherwise.
    abstract function isLeft(); # :: Either a b -> Bool

    # Return `Bool (True)` if the given value is a `Right`-value, `Bool (False)`
    # otherwise.
    abstract function isRight(); # :: Either a b -> Bool
  }

  # This function works like a constructor for the `Either` monad. It checks
  # the received value and return `Data.Either.Left x` or `Data.Either.Right x`.
  function Either($v) {
    if (is_null($v) || (is_object($v) && get_class($v) === "Data\\Null"))
      return new \Data\Either\Left($v);
    return new \Data\Either\Right($v);
  }
