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

  function λ($v) {
    return new \Data\Func($v);
  }

  function §() {
    return new \Data\Collection(func_get_args());
  }

  function bool($v) {
    return new \Data\Bool($v);
  }

  function boolean($v) {
    return new \Data\Bool($v);
  }

  function collection() {
    return new \Data\Collection(func_get_args());
  }

  function double($v) {
    return new \Data\Num\Float($v);
  }

  function dynamic($v) {
    return \Data\TypeInference :: infer($v);
  }

  function false() {
    return new \Data\Bool\FalseClass;
  }

  function either($v) {
    return \Data\Either($v);
  }

  function error($msg, $code) {
    return new \Data\Error($msg, $code);
  }

  function float($v) {
    return new \Data\Num\Float($v);
  }

  function func($v) {
    return new \Data\Func($v);
  }

  function int($v) {
    return new \Data\Num\Int($v);
  }

  function integer($v) {
    return new \Data\Num\Int($v);
  }

  function just($v) {
    return new \Data\Maybe\Just($v);
  }

  function lambda($v) {
    return new \Data\Func($v);
  }

  function left($v) {
    return new \Data\Either\Left($v);
  }

  function match($v) {
    return new \Data\Match($v);
  }

  function maybe($v) {
    return \Data\Maybe($v);
  }

  function nothing() {
    return new \Data\Maybe\Nothing;
  }

  function num($v) {
    return \Data\Num($v);
  }

  function number($v) {
    return new \Data\Num($v);
  }

  function obj($v) {
    return new \Data\Object($v);
  }

  function object($v) {
    return new \Data\Object($v);
  }

  function real($v) {
    return new \Data\Num\Float($v);
  }

  function right($v) {
    return new \Data\Either\Right($v);
  }

  function str($v) {
    return new \Data\Str($v);
  }

  function string($v) {
    return new \Data\Str($v);
  }

  function true() {
    return new \Data\Bool\TrueClass;
  }

  function tuple() {
    return new \Data\Tuple(func_get_args());
  }

  function undefined() {
    return new \Data\Undefined;
  }

  function void() {
    return new \Data\Void;
  }
