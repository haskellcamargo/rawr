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
    public function __construct($val);
    public function add_cslashes();
    public function add_slashes();
    public function ascii_only();
    public function b();
    public function byte_size();
    public function bytes();
    public function capitalize();
    public function char($char);
    public function char_at($where);
    public function chars();
    public function chomp($arg);
    public function chop();
    public function chr();
    public function clear();
    public function codepoints();
    public function cmp_case();
    public function concat();
    public function contains($what);
    public function crypt();
    public function delete($pattern);
    public function dump();
    public function down_case();
    public function each_byte($func);
    public function each_char($func);
    public function each_codepoint($func);
    public function each_line($func);
    public function encode();
    public function ends_with($what);
    public function equals($what);
    public function get_byte($byte);
    public function gsub($pattern, $by);
    public function hex();
    public function index($of);
    public function insert($what);
    public function is_empty();
    public function join($arr);
    public function l_just();
    public function l_strip();
    public function length();
    public function lines();
    public function match($with);
    public function next();
    public function oct();
    public function ord();
    public function ordinal_integer();
    public function output();
    public function outputln();
    public function prepend();
    public function r_index($i);
    public function r_just();
    public function r_partition();
    public function r_strip();
    public function repeat($times);
    public function replace($pattern, $by);
    public function reverse();
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
    public function swap_case();
    public function try_convert();
    public function unpack();
    public function up_case();
    public function words();
  }