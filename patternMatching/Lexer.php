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

  # This is the lexer. It is the base for the tokenizer and contains information
  # about EOF and also carries the values of the input, the current char and the
  # current position.
  abstract class Lexer {
    const EOF        = -1;
    const EOF_TYPE   =  1;
    protected $input
            , $pos   = 0
            , $char;

    # Receives the input and stores it. Defines the current char as the value 0
    # of the input, defined in $this->pos.
    function __construct($input) {
      $this->input = $input;
      $this->char  = $this->input[$this->pos];
    }

    # Increments the position of the current char and when the position is
    # greater or equals to the size of the input, we got the end of the file,
    # therefore the compiler can here stop. Otherwise, we let the current char
    # as the next char of the input.
    function consume() {
      $this->pos++;
      if ($this->pos >= strlen($this->input))
        $this->char = self :: EOF;
      else
        $this->char = $this->input[$this->pos];
    }

    # Responsible for iterating the characters and returning tokens.
    abstract function nextToken();
    # Responsible for giving readable information about the tokens.
    abstract function getTokenName($type);
  }
