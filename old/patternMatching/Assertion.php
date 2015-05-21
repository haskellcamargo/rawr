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

  # This class contains only static functions and is responsible by checking and
  # getting information about characters and strings.
  class Assertion {
    # A character is lower when it is an alpha char and the character equals to
    # itself when applied to strtolower function.
    static function isLower($char) { # boolean isLower(string char)
      return ctype_alpha($char) && $char == strtolower($char);
    }

    # A character is upper when it is an alpha char and the character equals to
    # itself when applied to strtoupper function;
    static function isUpper($char) { # boolean isUpper(string char)
      return ctype_alpha($char) && $char == strtoupper($char);
    }

    # A character is letter when it is an alpha char.
    static function isLetter($char) { # boolean isLetter(string char)
      return ctype_alpha($char);
    }
  }
