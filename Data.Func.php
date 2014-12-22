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
  use \ReflectionFunction;
  use \Data\Contract\IFunc as IFunc;
  use \TypeClass\Eq        as Eq;

  require_once 'Data.Contract.IFunc.php';

  class Func extends DataTypes implements IFunc {
    public $reflection;

    public function __construct($func) { # :: a -> a
      if (!is_callable($func) && !is_string($func))
        throw new Exception; # Not a closure.
      else {
        parent :: __construct();
        $this->value = $func;
        $this->reflection = new ReflectionFunction($func);
      }
    }

    # Function composition.
    public function ⃝($func) { # :: (Func, Func) -> Func
      # Math definition: (f ⃝ g)(x) = f(g(x)) where
      $let = [
        "f" =>  $this -> value
      , "g" =>  \Data\TypeInference :: toPrimitive($func)
      ];
      return new Func(function ($x) use ($let) {
        return $let['f']($let['g']($x));
      });
    }

    public function closScopeClass() { # :: Func -> ReflectionClass
      return $this->reflection->getClosureScopeClass();
    }

    public function closThis() { # :: Func -> Object
      return $this->reflection->getClosureThis();     
    }

    public function docComment() { # :: Func -> Str
      return ($temp = $this->reflection->getDocComment()) === false?
        new Bool(false)
      : new Str($temp);
    }

    public function endLine() { # :: Func -> Int
      return new Int($this->reflection->getEndLine());
    }

    public function export($ret = false) { # :: (Str, Maybe Bool) -> Str
      return new Str(ReflectionFunction :: export($this->value, $ret));
    }

    public function ext() { # :: Func -> ReflectionExtension
      return $this->reflection->getExtension();
    }

    public function extName() { # :: Func -> Str
      return ($temp = $this->reflection->getExtensionName()) === false?
        new Bool(false)
      : new Str($temp);
    }

    public function fileName() { # :: Func -> Str
      return new Str($this->reflection->getFileName());
    }

    public function clos() { # :: Func -> Closure
      return $this->reflection->getClosure();
    }

    public function inNs() { # :: Func -> Bool
      return new Bool($this->reflection->inNamespace());
    }

    # Own implementation for a 100% optimization in velocity.
    public function invoke() { # :: Maybe Dynamic -> Maybe Dynamic
      if (func_get_args() < $this->reflection->getNumberOfRequiredParameters())
        throw new Exception; # Required arguments.
      
      if (count($args = func_get_args()) > 0)
        return TypeInference :: infer(call_user_func_array($this->value, $args));
      else
        return TypeInference :: infer(call_user_func($this->value()));
    }

    public function isClos() { # :: Func -> Bool
      return new Bool($this->reflection->isClosure());
    }

    public function isDepr() { # :: Func -> Bool
      return new Bool($this->reflection->isDeprecated());
    }

    public function isDisabled() { # :: Func -> Bool
      return new Bool($this->reflection->isDisabled());
    }

    public function isGen() { # :: Func -> Bool
      return new Bool($this->reflection->isGenerator());
    }

    public function isInternal() { # :: Func -> Bool
      return new Bool($this->reflection->isInternal());
    }

    public function isUserDef() { # :: Func -> Bool
      return new Bool($this->reflection->isUserDefined());
    }

    public function isVariadic() { # :: Func -> Bool
      return new Bool($this->reflection->isVariadic());
    }

    public function name() { # :: Func -> Str
      return new Str($this->reflection->getName());
    }

    public function ns() { # :: Func -> Str
      return new Str($this->reflection->getNamespaceName());
    }

    public function numParam() { # :: Func -> Int
      return new Int($this->reflection->getNumberOfParameters());
    }

    public function numReqParam() { # :: Func -> Int
      return new Int($this->reflection->getNumberOfRequiredParameters());
    }

    # Alias to function composition.
    public function o($func) { # :: (Func, Func) -> Func
      # (f ⃝ g)(x) = f(g(x))
      return $this->⃝($func);
    }

    public function param() { # :: Func -> [ReflectionParameter] 
      return new Collection($this->reflection->getParameters());
    }

    public function retRef() { # :: Func -> Bool
      return new Bool($this->reflection->returnsReference());
    }

    public function shortName() { # :: Func -> Str
      return new Str($this->reflection->getShortName());
    }

    public function startLine() { # :: Func -> Int
      return new Int($this->reflection->getStartLine());
    }

    public function staticVar() { # :: Func -> Collection
      return new Collection($this->reflection->getStaticVariables());
    }
  }