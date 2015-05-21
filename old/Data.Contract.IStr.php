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

  namespace Data\Contract;

  interface IStr {
    public function __construct($val);               # :: a -> Str
    public function add_cslashes();
    public function add_slashes();
    public function ascii_only();
    public function b();
    public function byte_size();
    public function bytes();
    public function capitalize();                    # :: Str -> Str
    public function char($char);
    public function char_at($where);
    public function chars();                         # :: Str -> Collection
    public function chomp($arg);
    public function chop();
    public function chr();                           # :: Str -> Str
    public function clear();                         # :: Str -> Str
    public function codePoints();                    # :: Str -> Collection
    public function cmp_case();
    public function concat();                        # :: (Str ...) -> Str
    public function contains($what);
    public function crypt();
    public function delete($pattern);
    public function dump();
    public function toLower();                       # :: Str -> Str
    public function each_byte($func);
    public function eachChar($func);                # :: (Str, Func) -> Str
    public function eachCodePoint($func);           # :: (Str, Func) -> Str
    public function eachLine($func);                # :: (Str, Func) -> Str
    public function encode();
    public function ends_with($what);
    public function get_byte($byte);
    public function gsub($pattern, $by);
    public function hex();
    public function index($of);
    public function insert($what);
    public function is_empty();
    public function join($arr);                      # :: (Str, Collection) -> Str
    public function l_just();
    public function l_strip();
    public function length();                        # :: Str -> Int
    public function lines();                         # :: Str -> Collection
    public function match($with);
    public function next();
    public function oct();
    public function ord();
    public function ordinal_integer();
    public function putStr();                        # :: Str -> Str
    public function putStrLn();                      # :: Str -> Str
    public function prepend();
    public function r_index($i);
    public function r_just();
    public function r_partition();
    public function r_strip();
    public function repeat($times);                  # :: (Str, Int) -> Str
    public function replace($pattern, $by);
    public function reverse();                       # :: Str -> Str
    public function scan();
    public function scrub();
    public function set_byte($byte, $val);
    public function shuffle();
    public function slice($i, $j);
    public function split($pattern);
    public function squeeze();
    public function starts_with($what);
    public function strip();
    public function succ();
    public function sum();
    public function swapCase();                      # :: Str -> Str
    public function unpack();
    public function toUpper();                       # :: Str -> Str
    public function words();                         # :: Str -> Collection
  }