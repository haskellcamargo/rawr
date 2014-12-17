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

  # Don't shame on me! I'll change this all later... maybe

  namespace TypeDefinitionParser;

  (new Collection ('a', '...', 'z'))
  -> each (':atomize');

  abstract class AbstractSyntaxTree {
    const T_LPAREN = "(";
    const T_RPAREN = ")";
    const T_MINUS  = "-";
    const T_PLUS   = "+";
    const T_LBRACK = "[";
    const T_RBRACK = "]";
    const T_EQUAL  = "=";
    const T_RARR   = ">";
    const T_LARR   = "<";

    public function isDigit($x);
    public function isIdent($x);
    public function makeToken($k);
  }

  class SyntaxTree extends AbstractSyntaxTree {
    public function isDigit($x) {
      return (new Collection (1, '...', 9)
        -> elem ($x));
    }

    public function isLetter($x) {
      return (new Collection (a, '...', z))
        -> elem ($x);
    }
  }