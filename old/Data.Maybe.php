<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-24
  # @package       => Data.Maybe

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

  require_once 'Data.Contract.IMaybe.php';
  require_once 'Data.Maybe.Just.php';
  require_once 'Data.Maybe.Nothing.php';

  # A `Maybe` type encapsulates an optional value. A value of type `Maybe a`
  # either contains a value of type a (represented as `Just a`), or it is empty
  # (represented as `Nothing`). Using `Maybe` is a good way to deal with errors
  # or exceptional cases without resorting to drastic measures such as
  # `Data.Error`.
  #The `Maybe` type is also a monad. It is a simple kind of error monad, where
  # all errors are represented by `Nothing`. A richer error monad can be built
  # using the `Either` (`Data.Either`) type.
  abstract class Maybe extends DataTypes {
    # Equivalent to Haskell's `>>=` operator. Its first argument is a value in
    # a monadic type, its second argument is a function that maps from the
    # underlying type of the first argument to another monadic type, and its
    # results is in that other monadic type.
    abstract function bind($fn); # :: (Maybe a, Func) -> Maybe b

    # Extracts the element out of a `Just` and returns an error if its argument
    # is `Nothing`.
    abstract function fromJust(); # :: Maybe a -> a

    # Takes a `Maybe` value and a default value. If the `Maybe` is `Nothing`, it
    # returns the default values; otherwise, it returns the value contained in
    # the `Maybe`.
    abstract function fromMaybe($def); # :: (Maybe a, a) -> a

    # Returns `Bool (True)` if its argument is of the form `Just _`.
    abstract function isJust(); # :: Maybe a -> Bool

    # Returns `Bool (True)` if its arguments is of the form `Nothing`.
    abstract function isNothing(); # :: Maybe a -> Bool

    # Takes a default value, a function and, of course, a `Maybe` value. If the
    # `Maybe` value is `Nothing`, the function returns the default value.
    # Otherwise, it applies the function to the value inside the `Just` and
    # returns the result.
    abstract function maybe($def, $fn); # :: (Maybe a, b, Func) -> b

    # Returns an empty list when given ``Nothing`` or a singleton list when not
    # given ``Nothing``.
    abstract function toList(); # :: Maybe a -> Collection
  }

  # This function applies construction for `Maybe` monad. It is able to detect
  # and return `Just _` or `Nothing`, wrapping the value in a monadic
  # constructor in case of success.
  function Maybe($value) {
    # A value is nothing when it is null or instance of Data.Null. Otherwise, is
    # Just _.
    if (is_null($value) || is_object($value) and get_class($value) === "Data\\Null")
      return new \Data\Maybe\Nothing;
    return new \Data\Maybe\Just($value);
  }
