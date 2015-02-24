<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-24
  # @package       => Data.Either.Left

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

  namespace Data\Either;
  use \Data\Contract\Either\IEither;

  # This class can hold an error value, an operation that has failures.
  class Left extends \Data\Either implements IEither {
    function __construct($value) {
      $this->value = $value;
    }

    # Case analysis for the `Either` type. If the value is `Left a`, apply the
    # first function to a; if it is `Right b`, apply the second function to b.
    function either($f, $_) { # :: (Either a b, Func, Func) -> c
      return $f($this->value);
    }

    # Return `Bool (True)` if the given value is a `Left`-value, `Bool (False)`
    # otherwise.
    function isLeft() { # :: Either a b -> Bool
      return Bool(True);
    }

    # Return `Bool (True)` if the given value is a `Right`-value, `Bool (False)`
    # otherwise.
    function isRight() { # :: Either a b -> Bool
      return Bool(False);
    }
  }
