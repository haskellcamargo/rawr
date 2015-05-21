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
  use \Exception;

  require_once 'Data.Contract.ICollection.php';

  # Collections of all types.
  class Collection extends DataTypes implements Contract\ICollection {
    private $type     = "[]"
          , $position =   0;

    public function __construct() { # :: [a] -> Collection
      # Ensure type of all the elements in the list.
      # Collections are unityped.

      # Bindings to useful variables

      # Who said pattern matching doesn't exist in PHP?
      list ($args, $numArgs) = [func_get_args(), func_num_args()];

      if (gettype($args) === "array" && $numArgs === 1) {
        # Received a single list in format [n, n + 1, n + 2 ...]
        if (($list = $args[0]) === []) # Avoid use of `empty` function here
          return;

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
        if ($numArgs === 3 && $args[1] === '...') {
          $let['startAt'] = TypeInference :: to_primitive($args[0]);
          $let['endAt']   = TypeInference :: to_primitive($args[2]);
          if (gettype($let['startAt']) !== gettype($let['endAt']))
            throw new Exception("List range requires start value and end value to be of the same type.");

          $this->type  = gettype($let['startAt']);
          $this->value = range($let['startAt'], $let['endAt']);
        } else if ($numArgs === 4 && $args[2] === '...') {
          $let['startAt'] = TypeInference :: to_primitive($args[0]);
          $let['jmpVal']  = TypeInference :: to_primitive($args[1]);
          $let['endAt']   = TypeInference :: to_primitive($args[3]);

          # Type constraint
          if (gettype($let['startAt']) !== gettype($let['endAt'])
           || gettype($let['startAt']) !== gettype($let['jmpVal']))
            throw new Exception("List range requires start value and end value to be of the same type.");

          # Not working with characters.
          # Range by.
          $let['acc'] = array(); # Accumulator
          for ($i = $let['startAt']; $i <= $let['endAt']; $i += ($let['jmpVal'] - $let['startAt']))
            array_push($let['acc'], $i);

          $this->type  = gettype($let['startAt']);
          $this->value = $let['acc'];
        }
      }
    }

    # Returns the callable part of an object
    private function closure($lambda) { # :: Func -> Closure
      if (get_class($lambda) === "Closure")
        return $lambda;
      else if (get_class($lambda) === "Data\Func")
        return $lambda->value();
      else
        throw new Exception("Expecting Func or Closure.");
    }

    public function each($lambda) { # :: (Collection, Func) -> Collection
      $let['currying'] = $this->closure($lambda);

      foreach ($this->value as $item)
        $let['currying']($item);

      return new Collection($this->value);
    }

    # Filters a list according to the given predicate
    public function filter($lambda) { # :: (Collection, Func<Bool>) -> Collection
      $let['acc'] = array();
      $let['currying'] = $this->closure($lambda);

      foreach ($this->value as $item):
        $let['bool'] = TypeInference :: is_true($let['currying']($item));

        if ($let['bool'])
          array_push($let['acc'], $item);

      endforeach;

      return new Collection($let['acc']);
    }

    public function intersperse($item) {
      $let['acc'] = array();
      $let['add_pair_acc'] = function ($x, $y) use (&$let) {
        array_push($let['acc'], $x);
        array_push($let['acc'], $y);
      };

      foreach ($this->value as $t)
        $let['add_pair_acc']($t, $item);

      return new Collection($let['acc']);
    }

    # Mapping over a list.
    public function map($lambda) { # :: (Collection, Func) -> Collection
      $let =  [ 'acc'       =>  array()
              , 'currying'  =>  $this->closure($lambda)];
        
      foreach ($this->value as $item)
        array_push($let['acc'], $let['currying']($item));

      return new Collection($let['acc']);
    }

    # Casts the values of the list to object typed values
    public function of($type) { # :: Str -> Collection
      if ($this->type == "[]") {
        $this->type = str_replace(".", "\\", $type);
        return $this;
      }

      $let['class'] = str_replace(".", "\\", $type);

      if (!class_exists($let['class']))
        throw new Exception("Type `{$type}` not found.");
        
      $acc = array();
      for ($i = 0; $i < count($this->value); $i++)
        $acc[$i] = new $let['class']($this->value[$i]);
      return new Collection($acc);
    }

    public function reject($lambda) { # :: (Collection, Func<Bool>) -> Collection
      $let['acc']      = array();
      $let['currying'] = $this->closure($lambda);

      foreach ($this->value as $item):
        $let['bool'] = TypeInference :: is_true($let['currying']($item));

        if (!$let['bool'])
          array_push($let['acc'], $item);

      endforeach;

      return new Collection($let['acc']);
    }

    # This automagically implements operator overloading of [] and makes this
    # object iterable and countable. It acts really like an Array, but it is
    # an object.

    # (Countable a) => a -> Int
    public function count() {
      return new \Data\Num\Int(sizeof($this->value));
    }
  }