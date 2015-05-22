<?php

namespace Rawr\DataType
{
  use \Exception;
  use \Rawr\Collection;
  use \Rawr\Core\TypeInference;
  use \Rawr\Num\Int;
  use \Rawr\String;
  use \ReflectionFunction;

  /**
   * @package Rawr
   * @version 1.4.0.0
   */
  class Fun extends Type
  {
    /**
     * Holds the instance of ReflectionFunction.
     */
    private $reflObj;

    /**
     * Receives any value and tries to cast it to a function.
     * @author Marcelo Camargo
     * @param mixed $f
     * @return Fun
     */
    public function __construct($f)
    {
      TypeInference::assertCallable($f);

      $this->value = $f;
      $this->reflObj = new ReflectionFunction($f);
    }

    /**
     * Magic method for invocation with parenthesis.
     * @author Marcelo Camargo
     * @return Type
     */
    public function __invoke()
    {
      $arguments = func_get_args();

      if (count($arguments) > 0) {
        return TypeInference::determine(
          call_user_func_array($this->value, $arguments)
        );
      } else {
        return TypeInference::determine(call_user_func($this->value));
      }
    }

    /**
     * Returns this pointer bound to closure.
     * @author Marcelo Camargo
     * @return object
     */
    public function boundPointer()
    {
      return $this->reflObj->getClosureThis();
    }

    /**
     * Function composition, where `(f . g)(x) = f(g(x))`.
     * @author Marcelo Camargo
     * @param mixed $fn
     * @return Fun
     */
    public function compose($fn)
    {
      if (!is_callable($fn))
        throw new Exception;
        
      list($f, $g) = [$this->value, TypeInference::toPrimitive($fn)];

      return new Fun(function($x) use($f, $g) {
        return $f($g($x));
      });
    }

    /**
     * Gets doc comment.
     * @author Marcelo Camargo
     * @return String
     */
    public function docComment()
    {
      return new String($this->reflObj->getDocComment());
    }

    /**
     * Gets end line number.
     * @author Marcelo Camargo
     * @return Int
     */
    public function endLine()
    {
      return new Int($this->reflObj->getEndLine());
    }

    /**
     * Gets extension info.
     * @author Marcelo Camargo
     * @return ReflectionExtension
     */
    public function ext()
    {
      return $this->reflObj->getExtension();
    }

    /**
     * Gets extension name.
     * @author Marcelo Camargo
     * @return String
     */
    public function extName()
    {
      return new String($this->reflObj->getExtension);
    }

    /**
     * Gets file name.
     * @author Marcelo Camargo
     * @return String
     */
    public function fileName()
    {
      return new String($this->reflObj->getFileName());
    }

    /**
     * Direct call of __invoke()
     * @author Marcelo Camargo
     * @return Type
     */
    public function invoke()
    {
      return $this();
    }

    /**
     * Gets function name.
     * @author Marcelo Camargo
     * @return String
     */
    public function name()
    {
      return new String($this->reflObj->getName());
    }

    /**
     * Gets namespace name.
     * @author Marcelo Camargo
     * @return String
     */
    public function ns()
    {
      return new String($this->reflObj->getNamespaceName());
    }

    /**
     * Gets number of parameters.
     * @author Marcelo Camargo
     * @return Int
     */
    public function paramNum()
    {
      return new Int($this->reflObj->getNumberOfParameters());
    }

    /**
     * Gets parameters.
     * @author Marcelo Camargo
     * @return Collection<ReflectionParameter>
     */
    public function params()
    {
      return new Collection($this->reflObj->getParameters());
    }

    /**
     * Gets number of required parameters.
     * @author Marcelo Camargo
     * @return Int
     */
    public function reqParamNum()
    {
      return new Int($this->reflObj->getNumberOfRequiredParamters());
    }

    /**
     * Returns the scoope associated to the closure.
     * @author Marcelo Camargo
     * @return ReflectionClass
     */
    public function scope()
    {
      return $this->reflObj->getClosureScopeClass();
    }
  }
}