<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-25
  # @package       => Data.Match

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

    # Private methods

    private function matchLiteral($patternList) {
    # :: (Match a, Array<b, c>) -> Either Error c
      foreach ($patternList as $pattern => $whenMatch) {
        if ($this->value == $pattern)
          return Right($whenMatch);

      if (isset($patternList[otherwise]))
        return Right($patternList[otherwise]);

      return Left(Error(Str("No pattern found for the given value"), Int(0)));
      }
    }

    private function matchObject($patternList) {
    # :: (Match a, Array<b, c>) -> Either Error c
      $storedPatterns = [/* pattern => [ value :: [Str]
                                       , type  :: Int
                                       , func  :: Func
                                       ]*/];
      foreach ($patternList as $pattern => $whenMatch) {
        $words = explode(' ', $pattern);

        $patternType = HoldsValue;

        /**
         * How is the type definition for patterns.
         * Tokenization of the elements
         * TODO: Write a small predictive top-down recursive-descent parse
         * for matching patterns.
         *
         * +----------------------------+-------------------------------------+
         * |           Exemplo          |    Abstract syntax tree             |
         * |----------------------------+-------------------------------------+
         * | Just x                     | Obj<Just> Var <x>                   |
         * | Nothing                    | Obj<Nothing>                        |
         * | Int x                      | Obj<Int> Var <x>                    |
         * | Either a b                 | Obj<Either> Var <a> Var<b>          |
         * | Just Int x                 | Obj<Just> Obj<Int> Var<x>           |
         * | Just Int _                 | Obj<Just> Obj<Int> Wildcard         |
         * | Either (Err e) (Str x)     | Obj<Either>                         |
         * |                            |   Obj<Err> Var<e>                   |
         * |                            |   Obj<Str> Var<x>                   |
         * +----------------------------+-------------------------------------+
         *
         */

        $storedPatterns[] = [$pattern => [ /* value */ $words
                                         , /* type  */ $patternType
                                         , /* func  */ $whenMatch
                                         ]];
      }

      var_dump($let);
    }

    function with(array $patternList) {
    # :: (Match a, Array<b, c>) -> Either Error c
      # First, we verify if we want match an object (that can have constructor)
      # or a primitive scalar PHP value.
      return is_object($this->value) ? $this->matchObject($patternList)
      /* otherwise */                : $this->matchLiteral($patternList);
    }
  }
