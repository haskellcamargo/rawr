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
  
  class Match {
    private $value;
    
    function __construct($value) {
      $this->value = $value; 
    }
    
    private function isIdent($item) {
      if (!ctype_alpha($item[0]))
        return false;   

      for ($i = 1; $i < strlen($item); $i++)
        if (!ctype_alnum($item[$i]) && !ctype_punct($item[$i]))
          return false;
      
      return true;
    }
    
    private function validateConstrPattern($pattern) {
      $patternDivision = explode(" ", $pattern);
      if (($sizeArg = sizeof($patternDivision)) != 1 && $sizeArg != 2)
        throw new \Exception("Error on parsing arguments");
      
      foreach ($patternDivision as $item)
        if (!$this->isIdent($item) && $item !== otherwise)
          throw new \Exception("Invalid pattern");

      return $patternDivision;
    }
    
    private function _withConstr($patternList) {
      $objectClass = DataTypes :: typeName(get_class($this->value));

      foreach ($patternList as $pattern => $do) {
        $patternDivision = $this->validateConstrPattern($pattern);
        $sizeThatShouldBe = (isset($this->value->value) || $this->value->value === null ) ? 2 : 1;
        
        if (sizeof($patternDivision) == $sizeThatShouldBe
         && $objectClass             == $patternDivision[0])
          return $do($this->value);
      }
      
      if (isset($patternList[otherwise]))
        return $patternList[otherwise]($this->value);
      
      throw new \Exception("No matching pattern found for given value");
    }
    
    function withConstr($patternList = []) {
      if (!is_object($this->value))
        throw new \Exception("Pattern-matching with constructors just can be "
          . "applied for objects");
      switch ($patternList) {
        case []:
          throw new \Exception("No patterns have been specified.");
        default:
          return $this->_withConstr($patternList);
      }
    }
  }