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

  require_once 'Data.Contract.IMaybe.php';
  require_once 'Data.Maybe.Just.php';
  require_once 'Data.Maybe.Nothing.php';

  # Maybe is an exception for handling types as classes.
  # This happens because a constructor can't return data that applies to
  # an object.

  abstract class Maybe extends DataTypes {
    abstract function bind($fn);         # :: (Maybe a, Func) -> Maybe b
    abstract function fromJust();        # :: Maybe a -> a
    abstract function fromMaybe($def);   # :: (Maybe a, a) -> a
    abstract function isJust();          # :: Maybe a -> Bool
    abstract function isNothing();       # :: Maybe a -> Bool
    abstract function maybe($def, $fn);  # :: (Maybe a, a, Func) -> a
    abstract function toList();          # :: Maybe a -> Collection
  }

  function Maybe($value) {
    if (is_null($value) || is_object($value) and get_class($value) === "Data\\Null")
      return new \Data\Maybe\Nothing;
    return new \Data\Maybe\Just($value);
  }
