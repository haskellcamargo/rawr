<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-24
  # @package       => Data.Maybe.Just

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

  namespace Data\Maybe;
  use \Data\Func;
  use \Data\Contract\Maybe\IMaybe;

  # `Just` is a construct of the `Maybe` type/monad. It must carry a value.
  class Just extends \Data\Maybe implements IMaybe {
    function __construct($value) {
      $this->value = $value;
    }

    # Equivalent to Haskell's `>>=` operator. Its first argument is a value in
    # a monadic type, its second argument is a function that maps from the
    # underlying type of the first argument to another monadic type, and its
    # results is in that other monadic type.
    function bind($fn) { # :: (Maybe a, Func) -> Maybe b
      return $fn($this->value);
    }

    # Extracts the element out of a `Just` and returns an error if its argument
    # is `Nothing`.
    function fromJust() { # :: Maybe a -> a
      return $this->value;
    }

    # Takes a `Maybe` value and a default value. If the `Maybe` is `Nothing`, it
    # returns the default values; otherwise, it returns the value contained in
    # the `Maybe`.
    function fromMaybe($_) { # :: (Maybe a, a) -> a
      return $this->value;
    }

    # Returns `Bool (True)` if its argument is of the form `Just _`.
    function isJust() { # :: Maybe a -> Bool
      return Bool(True);
    }

    # Returns `Bool (True)` if its arguments is of the form `Nothing`.
    function isNothing() { # :: Maybe a -> Bool
      return Bool(False);
    }

    # Takes a default value, a function and, of course, a `Maybe` value. If the
    # `Maybe` value is `Nothing`, the function returns the default value.
    # Otherwise, it applies the function to the value inside the `Just` and
    # returns the result.
    function maybe($_, $fn) { # :: (Maybe a, b, Func) -> b
      return $fn($this->value);
    }

    # Returns an empty list when given ``Nothing`` or a singleton list when not
    # given ``Nothing``.
    function toList() { # :: Maybe a -> Collection
      return Collection([$this->value]);
    }
  }
