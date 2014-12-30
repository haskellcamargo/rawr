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

  class Object extends DataTypes {
    public  $prototype = null;
    private $typeOf    = [];

    public function __call($name, $arguments) {
      array_unshift($arguments, $this);
      if (is_object($this->{$name}))
        return call_user_func_array($this->{$name}->value(), $arguments);
      else
        return call_user_func_array($this->{$name}, $arguments);
    }

    public function __construct($v = []) {
      if (gettype($v) === "array" && !empty($v))
        foreach ($v as $property => $type)
          if (is_string($property))
            $this->typeOf[$property] = $type;
          else
            throw new Exception("Not an identifier: {$property}");
    }
    
    public function __set($property, $value) {
      if (isset($this->typeOf[$property]))
        if (is_array($this->typeOf[$property]) && sizeof($this->typeOf[$property])) {

        } else     # PHP && operator works like Erlang's andelse.
          if (is_object($value) && get_class($value) == $this->typeOf[$property]) # Rawr object, no need of optimization
            $this->{$property} = $value;
          else {
              $className = "\\" . $this->typeOf[$property];
              $this->{$property} = new $className($value);
          }
      else
        throw new Exception("Object has no property '{$property}'.");
    }
  }