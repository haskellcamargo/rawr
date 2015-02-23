<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-23
  # @package       => Data.Tuple

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

  require_once 'Data.Contract.ITuple.php';

  # The ``Tuple`` type is a different way of storing multiple values in a single
  # value. The main differences between tuples and lists are that tuples have a
  # fixed number of elements (immutable); therefore, it makes sense to use
  # tuples when you known in advance how many values are to be stored. For
  # example, we might want a type for storing 2D coordinates of a point. We
  # known exactly how many values we need for each point (two - the x and y
  # coordinates), so tuples are applicable. The elements of a tuple do not need
  # to be all of the same type. For instance, in a phonebook application we
  # might want to handle the entries by crunching three values into one: the
  # name, phone number, and the address of each person. In such a case, the
  # three values won't havve the same type, so lists wouldn't help, but tuples
  # would.
  class Tuple extends DataTypes implements Contract\ITuple {
    # $size determines the size that a tuple have, statically. This value is
    # immutable. $type represents a list containing the type of each element.
    private $size =  0
          , $type = [];

    # Constructor is variadic. ITuples should be classified as dependent types.
    # ONLY objects can be put inside tuples. This is made to avoid workarounds
    # that the programmer can do.
    function __construct() {
      $this->size = func_num_args();
      foreach ($args = func_get_args() as $item)
        $this->type[] = parent :: typeName(get_class($node));
      $this->value = $args;
    }

    # Returns `Just` the first element of a tuple (if it exists), or `Nothing`.
    function fst() { # :: Tuple<a>(Int) -> Maybe a
      return isset($this->value[0])? Just($this->value[0])
      /* otherwise */              : Nothing();
    }

    # Works like a 1-indexed array, where you get `Just` the element in the
    # received index or ``Nothing``.
    function get(Num $index) { # :: (Tuple, Int) -> Maybe a
      return isset($this->value[$index - 1])? Just($this->value[$index - 1])
      /* otherwise */                       : Nothing();
    }

    # Returns `Just` the second element of a tuple (if it exists), or `Nothing`.
    function snd() { # :: Tuple<a, b>(Int) -> Maybe b
      return isset($this->value[1])? Just($this->value[1])
      /* otherwise */              : Nothing();
    }

    # Returns the type of the items contained in the tuples in format of a
    # `Data.Str`.
    function showType() { # :: Tuple<a, b>(Int) -> Maybe b
      return new \Data\Str(
        "Tuple<" . implode(", ", $this->type) . ">({$this->size})");
    }

    # Swaps the values of a pair and returns `Just` the tuple or returns
    # `Nothing` in case of not-a-pair.
    function swap() { # :: Tuple -> Maybe Tuple
      if ($this->size == 2)
        return Just(Tuple($this->value[1]
                        , $this->value[0]));
      return Nothing();
    }
  }
