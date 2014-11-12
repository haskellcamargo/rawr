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

  # Use memoization to store already processed data in a static variable
  # This way you can increase the performance in more than 95% of 
  # already processed data.

  require_once 'IString.interface.php';

  class String extends DataTypes {
    # By default, data types that inherit from this class
    # and don't override the constructor must pass the internal
    # value of the variable in it.
    # Mixed → Void
    public function __construct($val) {
      parent :: __construct();
      $this->value = (string) $val;
    }

    # Returns the length of the string in bytes.
    # String → Integer
    public function byte_size() {
      return new Integer(mb_strlen($this->value));
    }

    # Returns the string with the first character converted to
    # uppercase and the remainder to lowercase. Note: case 
    # conversion is effective only in ASCII region.
    # String → String
    public function capitalize() {
      $string = str_split(strtolower($this->value));
      $this->value = strtolower($this->value);
      for ($i = 0; $i < count($string); $i++) {
        if (preg_match('/[a-z]|[A-Z]/', $string[$i])) {
          $this->value[$i] = strtoupper($string[$i]);
          return $this;
        }
      }
      return $this;
    }

    # Returns an array of characters in string.
    # String -> [String]
    public function chars() {
      $this->value = new Collection(explode('', $this->value));
    }

    # Returns a string with the given record separator removed from
    # the end of str, if present. Case of no parameters, chomp can
    # remove carriage return characters (that is it will remove \n,
    # \r, and \r\n).
    # String -> [String]
    public function chomp($arg = false) {
      if ($arg !== false) {
        // Implement chomp on string
      }

      $rec_chomp = function() {
        if (($ref = ($this->value[strlen($this->value) - 1]) == 'n' || $ref == 'r')
          && $this->value[strlen($this->value) - 2] == '\\') {
          $this->value = substr($this->value, 0, -2);
          $rec_chomp();
        } else return null;
      };

      if (is_null($rec_chomp()))
        return $this->value;
    }

    # Returns a one-character string at the beginning of the string.
    # String → Char
    public function chr() {
      return new Char($this->value[0]); 
    }

    # Makes string empty
    # String → String
    public function clear() {
      $this->value = "";
      return $this;
    }

    # Returns an array of the Integer ordinals of the characters in
    # String → [Integer]
    public function code_points() {
      $integers = Array();
      foreach ($this->value as $char) {
        if (preg_match('/\d/', $char)) {
          array_push($integers, (int) $char);
        }
      }
      return new Collection($integers);
    }

    # Append the given object to string. If object is an Integer,
    # it is considered as a codepoint, and is converted to a character
    # before concatenation.
    # String → String
    public function concat() {
      for ($i = 0; $i < count(func_get_args()); $i++) {
        if (is_integer(func_get_args()[$i])) {
          $this->value = $this->value . chr(func_get_args()[$i]);
        } else $this->value = $this->value . func_get_args()[$i];
      }
      return $this;
    }

    # Downcases a string.
    # String → String
    public function down_case() {
      $this->value = strtolower($this->value);
      return $this;
    }
    
    # Applies a function to each char in the string
    # String → Void
    public function each_char($func) {
      $this->chars()->each($func);
    }
    
    # Applies a function to each codepoint in the string
    # String → Void
    public function each_codepoint($func) {
      $this->codePoints()->each($func);
    }
    
    # Applies a function to each line
    # String → Void
    public function each_line($func) {
      $this->lines()->each($func);
    }

    # Joins a list with the specified separator
    # String → String → [String]
    public function join($arr) {
      $this->value = join($this->value, $arr);
      return $this;
    }
    
    # Returns the length of a string
    # String → Integer
    public function length() {
      return new Integer(strlen($this->value));
    }

    # Splits a string at newlines into a list.
    # String → [String]
    public function lines() {
      return new Collection(
        preg_replace("/\t/", "", explode("\n", $this->value)));
    }

    # Outputs to screen a string and doesn't break line.
    # String → Void
    public function output() {
      echo $this->value;
      return $this;
    }

    # Outputs to screen a string and breaks line.
    # String → Void
    public function outputln() {
      echo $this->value . "<br>\n";
      return $this;
    }

    # Returns a collection of the string separated by the
    # given pattern.
    # String → [String]
    public function split($pattern) {
      return new Collection(split($pattern, $this->value));
    }

    # Takes its second argument, and repeats it n times to create a new,
    # single, string.
    # String → Integer → String
    public function repeat($times) {
      $res = $this->value;
      for ($i = 0; $i < $times - 1; $i++)
        $res .= $this->value;
      $this->value = $res;
      return $this;
    }

    # Reverses a string.
    # String → String
    public function reverse() {
      $memoize = $this->memoize;
      $reverse = $memoize (function() {
        $str = '';
        for ($i = strlen($this->value) - 1; $i >= 0; $i--)
          $str .= $this->value[$i];
        $this->value = $str;
      });
      $reverse();
      return $this;
    }

    # Tries to convert something to a string.
    # Mixed → Maybe String
    public function try_convert() {
      $this->value = (string) $this->value;
      return $this;
    }

    # Converts a string to uppercase.
    # String → String
    public function up_case() {
      $this->value = strtoupper($this->value);
      return $this;
    }

    # Swaps the case of a string.
    # String → String
    public function swap_case() {
      $newString = '';
      foreach (str_split($this->value) as $char) {
        if (preg_match('/[a-z]/', $this->value))
          $newString .= strtoupper($char);
        else if (preg_match('/[A-Z]/', $this->value))
          $newString .= strtolower($char);
        else
          $newString .= $char;
      }
      $this->value = $newString;
      return $this;
    }

    # Splits a string at spaces (one or more), returning
    # a list of strings
    # String → [String]
    public function words() {
      return (new Collection(
        explode(' ', $this->value)
        , 'String'))
      -> reject(function($x) {
        return $x == '';
      });
    }
  }