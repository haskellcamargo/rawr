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
        throw new Exception; # Not a closure.
      else {
        parent :: __construct();
        $this->value = $func;
        $this->reflection = new ReflectionFunction($func);
      }
    }

    public function clos_scope_class() { # :: Func -> ReflectionClass
      return $this->reflection->getClosureScopeClass();
    }

    public function clos_this() { # :: Func -> Object
      return $this->reflection->getClosureThis();     
    }

    public function doc_comment() { # :: Func -> String
      return ($temp = $this->reflection->getDocComment()) === false?
        new Boolean(false)
      : new String($temp);
    }

    public function end_line() { # :: Func -> Int
      return new Int($this->reflection->getEndLine());
    }

    public function export($ret = false) { # :: (String, String) -> String
      return new String(ReflectionFunction :: export($this->value, $ret));
    }

    public function extension() { # :: Func -> ReflectionExtension
      return $this->reflection->getExtension();
    }

    public function extension_name() { # :: Func -> String
      return ($temp = $this->reflection->getExtensionName()) === false?
        new Boolean(false)
      : new String($temp);
    }

    public function file_name() { # :: Func -> String
      return new String($this->reflection->getFileName());
    }

    public function get_closure() { # :: Func -> Closure
      return $this->reflection->getClosure();
    }

    public function in_ns() { # :: Func -> Boolean
      return new Boolean($this->reflection->inNamespace());
    }

    # Own implementation for a 100% optimization in velocity.
    public function invoke() { # :: Maybe Dynamic -> Maybe Dynamic
      if (func_get_args() < $this->reflection->getNumberOfRequiredParameters())
        throw new Exception; # Required arguments.
      
      if (count($args = func_get_args()) > 0)
        return TypeInference :: infer(call_user_func_array($this->value, $args));
      else
        return TypeInference :: infer($this->value()); 
        # call_user_func is 125% slower than a simple call.
    }

    public function is_disabled() { # :: Func -> Boolean
      return new Boolean($this->reflection->isDisabled());
    }

    public function name() { # :: Func -> String
      return new String($this->reflection->getName());
    }

    public function ns_name() { # :: Func -> String
      return new String($this->reflection->getNamespaceName());
    }

    public function num_param() { # :: Func -> Int
      return new Int($this->reflection->getNumberOfParameters());
    }

    public function num_req_param() { # :: Func -> Int
      return new Int($this->reflection->getNumberOfRequiredParameters());
    }

    public function param() { # :: Func -> [ReflectionParameter] 
      return new Collection($this->reflection->getParameters());
    }

    public function short_name() { # :: Func -> String
      return new String($this->reflection->getShortName());
    }

    public function start_line() { # :: Func -> Int
      return new Int($this->reflection->getStartLine());
    }

    public function static_var() { # :: Func -> [Dynamic]
      return new Collection($this->reflection->getStaticVariables());
    }
  }