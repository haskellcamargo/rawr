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

  require_once 'IFunc.interface.php';

  class Func extends DataTypes implements IFunc {
    public $reflection;

    public function __construct($func) {
      if (!is_callable($func))
        throw new Exception;
      else {
        parent :: __construct();
        $this->value = $func;
        $this->reflection = new ReflectionFunction($func);
      }
    }

    public function invoke() {
      if (func_get_args() < $this->reflection->getNumberOfRequiredParameters());

      if (count($args = func_get_args()) > 0)
        return TypeInference :: infer(call_user_func_array($this->value, $args));
      else
        return TypeInference :: infer(call_user_func($this->value));
    }
  }