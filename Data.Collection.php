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

      # Bindings to useful variables
      $let['args']    = func_get_args();
      $let['numArgs'] = func_num_args();

      if (gettype($let['args']) === "array" && $let['numArgs'] === 1) {
        # Received a single list in format [n, n + 1, n + 2 ...]
        if (($list = $let['args'][0]) === []) # Avoid use of `empty` function here
          return;                             # I prefer pattern matching :/

        $let['typeConstraint'] = function ($predicate) use ($list) { # :: Closure -> (Throws TypeException)
          $this->type = $predicate($list[0]);
          # Pass by each element of the list checking if its type matches
          # with the type of the head of the list.
          foreach ($list as $item):
            if ($predicate($item) !== $this->type) { # Type constraint
              $let['t'] = is_object($item) ? get_class($item) : gettype($item);
              throw new Exception("Type constraint: Expecting `it` to be of type {$this->type}. Instead got {$let['t']}.");
            }
          endforeach;
        };

        if (is_object($list[0]))
          $let['typeConstraint']('get_class');
        else
          $let['typeConstraint']('gettype');

        $this->value = $list;
      } else {
        # String parsing for list generation.
      }
    }

    # Mapping.
    public function map($lambda) { # :: [a] -> [a]
      $let['t'] = array();
      foreach ($this->value as $item) {
        $let['currying'] = \Data\TypeInference :: to_primitive($lambda);
        array_push($let['t'], $let['currying']($item));
      }
      return new Collection($let['t']);
    }
  }