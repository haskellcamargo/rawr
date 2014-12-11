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
  
  class TypeInference {
    public static function infer($variable) {

      if (is_float($variable))
        return real ($variable);
 
      else if (is_integer($variable))
        return int ($variable);

      else if (is_string($variable))
        return string ($variable);

      else if (is_array($variable))
        return collection ($variable);

      else if (is_bool($variable))
        return bool ($variable);

      else if (is_callable($variable))
        return func ($variable);

      else if (is_null($variable))
        return Null;

      else return $variable;
    }

    public static function to_primitive($variable) {
      if (is_object($variable)) {
        if (method_exists(get_class($variable), 'value')) {
          return $variable->value();
        } else {
          if ($variable instanceof TrueClass) 
            return True;
          else if ($variable instanceof FalseClass)
            return False;
          else
            return Null;
        }
      } else {
        return $variable;
      }
    }
  }