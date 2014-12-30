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
 
  require_once 'Data.Contract.IStr.php';
  use \TypeClass\Eq as Eq;

  class Str extends DataTypes {
    # By default, data types that inherit from this class
    # and don't override the constructor must pass the internal
    # value of the variable in it.
    function __construct($val) { # :: a -> String
      parent :: __construct(); # Apply memoization
      $this->value = (string) $val;
    }

    # Returns the string with the first character converted to
    # uppercase and the remainder to lowercase. Note: case 
    # conversion is effective only in ASCII region
    function capitalize() { # :: Str -> Str
      $let['acc'] = strtolower($this->value);
      for ($i = 0, $len = strlen($let['acc']); $i < $len; $i++)
        if (preg_match('/[a-zA-Z]/', $let['acc'][$i])) {
          $let['acc'][$i] = strtoupper($let['acc'][$i]);
          return new Str($let['acc']);
        }

      return new Str($let['acc']);
    }

    # Returns an array of characters in string.
    function chars() { # :: Str -> Collection
      return new Collection(str_split($this->value));
    }

    # Returns a one-character string at the beginning of the string.
    function chr() { # :: Str -> Str
      return new Str($this->value[0]); 
    }

    # Makes string empty
    function clear() { # :: Str -> Str
      return new Str('');
    }

    # Returns an array of the Integer ordinals of the characters in
    function codePoints() { # :: Str -> Collection
      $let['acc'] = [];
      for ($i = 0, $len = strlen($this->value); $i < $len; $i++)
        array_push($let['acc'], (int) ord($this->value[$i]));
      return new Collection($let['acc']);
    }

    # Append the given object to string. If object is an Integer,
    # it is considered as a codepoint, and is converted to a character
    # before concatenation.
    function concat() { # :: (Str ...) -> Str
      $let['acc']  = $this->value;
      $let['args'] = func_get_args();
      for ($i = 0, $len = func_num_args(); $i < $len; $i++)
        if (is_integer($let['args'][$i]) || $let['args'][$i] instanceof \Data\Num\Int) {
          $let['acc'] .= gettype($let['args'][$i]) === "object" ? 
            chr((string) $let['args'][$i])
          : chr($let['args'][$i]);
        } else $let['acc'] .= $let['args'][$i];

      return new Str($let['acc']);
    }

    # Downcases a string.
    function toLower() { # :: Str -> Str
      return new Str(strtolower($this->value));
    }

    function diff(Str $y) { # :: (Eq a) => (a, a) -> Bool
      return new Data\Bool(Eq :: diff($this->value, $y->value()));
    }

    function eq(Str $y) { # :: (Eq a) => (a, a) -> Bool
      return new Data\Bool(Eq :: eq($this->value, $y->value())); 
    }
    
    # Applies a function to each char in the string
    function eachChar($func) { # :: (Str, Func) -> Str
      $this->chars()->each($func);
      return $this;
    }
    
    # Applies a function to each codepoint in the string
    function eachCodePoint($func) { # :: (Str, Func) -> Str
      $this->codePoints()->each($func);
      return $this;
    }
    
    # Applies a function to each line
    function eachLine($func) { # :: (Str, Func) -> Str
      $this->lines()->each($func);
    }

    # Joins a list with the specified separator
    function join($arr) { # :: (Str, Collection) -> Str
      return new Str(join($this->value, TypeInference :: to_primitive($arr)));
    }
    
    # Returns the length of a string
    function length() { # :: Str -> Int
      return new Num\Int(strlen($this->value));
    }

    # Splits a string at newlines into a list.
    # String → [String]
    function lines() {
      return (new Collection(
        preg_replace("/\t/", "", explode("\n", $this->value)))) -> of ('Data.Str');
    }

    # Outputs to screen a string and doesn't break line.
    function putStr() { # :: Str -> Str
      echo $this->value;
      return $this;
    }

    # Outputs to screen a string and breaks line.
    function putStrLn() { # :: Str -> Str
      echo $this->value . "\n";
      return $this;
    }

    # Returns a collection of the string separated by the
    # given pattern.
    function split($pattern) { # :: (Str, Str) -> Collection
      return new Collection(split($pattern, $this->value));
    }

    # Takes its second argument, and repeats it n times to create a new,
    # single, string.
    function repeat($times) { # :: (Str, Int) -> Str
      $let['acc'] = $this->value;
      for ($i = 0; $i < $times - 1; $i++)
        $let['acc'] .= $this->value;
      return new Str($let['acc']);
    }

    # Reverses a string.
    function reverse() { # :: Str -> Str
      $memoize = $this->memoize;
      $reverse = $memoize (function() {
        $str = '';
        for ($i = strlen($this->value) - 1; $i >= 0; $i--)
          $str .= $this->value[$i];
        return $str;
      });
      return new Str($reverse());
    }

    # Converts a string to uppercase.
    function toUpper() { # :: Str -> Str
      return new Str(strtoupper($this->value));
    }

    # Swaps the case of a string.
    function swapCase() { # :: Str -> Str
      $strcopy = $this->value;
      for ($i = 0, $len = strlen($strcopy); $i < $len; $i++)
        if (preg_match('/[a-z]/', $strcopy[$i]))
          $strcopy[$i] = strtoupper($strcopy[$i]);
        else if (preg_match('/[A-Z]/', $strcopy[$i]))
          $strcopy[$i] = strtolower($strcopy[$i]);
      return new Str($strcopy);
    }

    # Splits a string at spaces (one or more), returning
    # a list of strings
    function words() { # :: Str -> Collection
      return (new Collection (explode(' ', $this->value)))
      -> of ('Data.Str');
    }

    # Returns if the current string value is prefix of the parameter
    function isPrefixOf($of) { # :: (Str, Str) -> Bool
      # Re-implementation of comparasion basis
      # Non-deterministic parsing. Faster than using preg_match
      # [pass] => [pass] => [pass] => [pass] ...
      #        => [fail] => [break]
      # Apply this function by use of recursion:
      $isPrefixOf = function ($prefix, $string) use (&$isPrefixOf) {
        # Edge condition:
        if ($prefix == "")
          return new Bool(True);

        # Compare head.
        if ($prefix[0] === $string[0])
          return $isPrefixOf(substr($prefix, 1), substr($string, 1));

        return new Bool(False);
      };

      return $isPrefixOf($this->value, $of);
    }

    # Returns if the current string value is suffix of the parameter
    function isSuffixOf($of) { # :: (Str, Str) -> Bool
      # Same application to isSuffixOf
      # HOLY SHIT!
      # WHY SUBSTR DON'T EAT THE LAST ELEMENT OF THE STR!?
      $isSuffixOf = function ($suffix, $string) use (&$isSuffixOf) {
        echo $suffix . " <+> " . $string . "<br />";
        # Edge condition:
        if ($suffix == "")
          return new Bool(True);

        # Compare last.
        if (($t = $suffix[strlen($suffix) - 1]) === ($t1 = $string[strlen($string) - 1])) {
          return $isSuffixOf(substr($suffix, -(strlen($suffix) - 1)), substr($string, -(strlen($string) - 1)));
        }

        return new Bool(False);
      };

      return $isSuffixOf($this->value, $of);
    }
  }