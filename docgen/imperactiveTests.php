<?php
  namespace Data;
  use \Closure;
  use \Countable;
  use \Exception;
  use \ReflectionClass;

  function map(Closure $fn, array $list) {
    $arr = [];
    foreach ($list as $item)
      $arr[] = $fn($item);
    return $arr;
  }

  function each(Closure $fn, array $list) {
    foreach ($list as $item)
      $fn($item);
    return $list;
  }

  function filter(Closure $fn, array $list) {
    $arr = [];
    foreach ($list as $item)
      if ($fn($item))
        $arr[] = $item;
    return $arr;
  }

  require_once "../Data.Types.php";

  class ClassHolder implements Countable {
    private $publicMethods   = 0
          , $methods         = null;

    function __construct($className) {
      if (class_exists($className)) {
        $reflectionClass = new ReflectionClass($className);
        $this->methods   = $reflectionClass->getMethods();
      }
      else
        throw new Exception("Class '{$className}' not found.");
    }

    function count() {
      return $this->publicMethods;
    }

    function listMethods() {
      return $this->methods;
    }

    function listPublicMethods() {
      return filter(function (\ReflectionMethod $method) {
        return $method->isPublic();
      }, $this->methods);
    }

    static function parseDocComments($doc) {
      list ($doc, $res) = [explode("\n", $doc), []];
      foreach ($doc as $line) {
        $line = trim($line);
        if ($line == "/**" || $line == "*/")
          continue;
        /* otherwise */
        if ($line[0] == "*") {
          $simpleData = "/\*\s*@([a-z\|]+)\s*:\s*(.*)/";
          $out = null;
          $match = preg_match($simpleData, $line, $out);
          if ($match) {
            $res[] = [$out[1], $out[2]];
            # Continue here by merging arrays with same key.
          }
          continue;
        }
        throw new Exception("Expecting '*' as the first character of line.");
      }
      return $res;
    }
  }

  class Method {
    public $name, $class, $type, $about;
  }

  $methodList = [];

  # Application

  $data["num"] = new ClassHolder("\\Data\\Num");

  each(function ($item) {
    $t = ClassHolder :: parseDocComments($item->getDocComment());
    var_dump($t);
  }, filter (function (\ReflectionMethod $method) {
    return $method->getDocComment();
  }, $data["num"]->listPublicMethods()));
