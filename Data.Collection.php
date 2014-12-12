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
  use \Exception;

  # Collections of all types.
  class Collection extends DataTypes {
    private $type = "[]";

    public function __construct() { # a -> a
      # Ensure type of all the elements in the list.
      # Collections are unityped.
      $arguments = func_get_args();
      if (gettype($arguments) === "array" && func_num_args() === 1) {
        # Received a single list in format [n, n + 1, n + 2 ...]
        if (($list = $arguments[0]) === []) # Avoid use of `empty` function here
          return;                           # I prefer pattern matching :/

        else {
          if (is_object($list[0])) { # It's possibly a Rawr type
            $this->type = get_class($list[0]);
            foreach ($list as $item)
              if (get_class($item) !== $this->type) { # Type constraint
                $let["t"] = is_object($item) ? get_class($item) : gettype($item);
                throw new Exception("Type constraint: Expecting `it` to be of type {$this->type}. Instead got {$let['t']}.");
              }

          } else { # It's a primitive value
            $this->type = gettype($list[0]);
            foreach ($list as $item) {
              if (gettype($item) !== $this->type) { # Type constraint
                $let["t"] = is_object($item) ? get_class($item) : gettype($item);
                throw new Exception("Type constraint: Expecting `it` to be of type {$this->type}. Instead got {$let['t']}.");
              }
            }
          }

          $this->value = $list;
        }
      }
    }

    # Mapping.
    public function map($lambda) { # :: [a] -> [a]
      $t = array();
      foreach ($this->value as $item) {
        $let['currying'] = \Data\TypeInference :: to_primitive($lambda);
        $let['currying']();
      }

      return $this; # As much as types are secure, we can return
                    # the same object with the exact same type.
    }
  }