<?php
  # Copyright (c) 2014 Haskell Camargo <haskell@linuxmail.org>
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

  # Collections of all types.
  class Collection extends DataTypes {
    public function __construct($arr) {
      $this->value = $arr;
      return $this;
    }

    # Returns a new list which contains only the truthy values of the inputted list.
    # [a] → [a]
    public function compact() {
      $arr = Array();
      foreach ($this->value as $atom) {
        if ($atom) array_push($arr, $atom);
      }
      $this->value = $arr;
      return $this;
    }

    # Applies a function to each item in the list and returns the original list.
    # (a → Undefined) → [a] →[a]
    public function each($clos) {
      foreach ($this->value as $atom)
        $clos($atom);
      return $this;
    }

    # Applies a function to each string in the list and returns the original list.
    # (a → String) → [a] →[a]
    public function each_s($clos) {
      foreach ($this->value as $atom)
        $clos(new String($atom));
      return $this;
    }

    # Returns a new list composed of the items which pass the supplied function's
    # test. 
    # (a → Boolean) → [a] → [a]
    public function filter($clos) {
      $arr = Array();
      foreach ($this->value as $atom)
        if ($clos($atom))
          array_push($arr, $atom);
      $this->value = $arr;
      return $this;
    }

    # A function which does nothing: it simply returns its single argument.
    # Useful as a placeholder.
    # a → a
    public function id() {
      return $this;
    }

    # Returns an element by index.
    # [a] → [a]
    public function index_arr($i) {
      $res = (array) $this->value;
      $to_primitive = Array();
      foreach ($res as $result)
        array_push($to_primitive, $result);
      $this->value = new Collection($to_primitive[0][$i]);
      return $this;
    }

    # Returns an element by index.
    # [a] → [a]
    public function on($i) {
      $res = (array) $this->value;
      $this->value = $res[$i];
      return $this;
    }

    # Takes a string (type name) and a value, and returns if the value is of
    # that type. Uses PHP's typeof operator.
    # String → a → Boolean
    public function is_type($type) {
      return new Boolean(typeof($this->value) == $type);
    }

    # Applies a function to each item in the list, and produces a new list with the
    # results. The length of the result is the same length as the input.
    # (a → b) → [a] → [b]
    public function map($clos) {
      $arr = Array();
      foreach ($this->value as $atom)
        array_push($arr, $clos($atom));
      $this->value = $arr;
      return $this;
    }

    # Returns the mean of a collection
    #

    # Merges two collections in one
    # [a] → [a]
    public function merge($collection) {
      $this->value = array_merge($this->value, $collection);
      return $this;
    }

    # Gives the product of a numeric collection
    # [a] → Maybe a
    public function product() {
      // TODO: Memoize it.
      $arr = (array) $this->value;
      $product = $arr[0];
      foreach ($this->value as $entry) {
        $product *= $entry;
      }
      return new Integer($product);
    }

    # Equivalent to [(filter f, xs), (reject f, xs)], but more efficient, 
    # using only one loop.
    # (a → Boolean) → [a] → [[a], [a]]
    public function partition($clos) {
      $filter = Array();
      $reject = Array();
      foreach ($this->value as $atom)
        if ($clos($atom))
          array_push($filter, $atom);
        else array_push($reject, $atom);
      $this->value = new Collection(Array($filter, $reject));
      return $this;
    }

    # Removes the last element of the collection
    # [a] → [a]
    public function pop() {
      array_pop($this->value);
      return $this;
    }

    # Pushes an element to the collection
    # [a] → [a]
    public function push($atom) {
      array_push($this->value, $atom);
      return $this;
    }

    # Like filter, but the new list is composed of all the items which fail the
    # function's test.
    # (a → Boolean) → [a] → [a]
    public function reject($clos) {
      $arr = Array();
      foreach ($this->value as $atom)
        if (!$clos($atom))
          array_push($arr, $atom);
      $this->value = $arr;
      return $this;
    }

    # Reverses a collection
    # [a] → [a]
    public function reverse() {
      $this->value = array_reverse($this->value);
      return $this;
    }

    # Gets the sum of the items in the collection
    # [a] → Integer
    public function sum() {
      return new Integer(array_sum($this->value));
    }
  }