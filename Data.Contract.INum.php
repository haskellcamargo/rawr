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

  namespace Data\Contract;
  use \Data\Num;
  use \Data\Num\Int;
  use \Data\Num\Float;

  # In `PHP interfaces, `public` keyword is redundant because all methods
  # declared in it must be obligatory public. Interfaces can act like
  # final abstract classes in the backend, allowing type hinting, with the singular
  # difference that they cannot show the implementation of a method.
  # Well, they are a PHP workaround with basis on final abstract classes.
  # That's why you cannot create a final abstract class in PHP.

  interface INum {
  #      | METHOD NAME       |  METHOD ARGUMENTS           | TYPE SIGNATURE
    function abs                ();                        # :: Num -> Num
    function arcCos             ();                        # :: Num -> Float
    function add                (Num &$n);                 # :: (Num, Num) -> Num
    function arcSin             ();                        # :: Num -> Float
    function arcTan2            (Num &$n);                 # :: (Num, Num) -> Float
    function arcTan             ();                        # :: Num -> Float
    function ceil               ();                        # :: Num -> Float
    function cos                ();                        # :: Num -> Float
    function degToRad           ();                        # :: Num -> Float
    function div                (Num &$n);                 # :: (Num, Num) -> Num
    function exp                ();                        # :: Num -> Float
    function expm1              ();                        # :: Num -> Float
    function floor              ();                        # :: Num -> Float
    function hArcCos            ();                        # :: Num -> Float
    function hArcSin            ();                        # :: Num -> Float
    function hArcTan            ();                        # :: Num -> Float
    function hCos               ();                        # :: Num -> Float
    function hSin               ();                        # :: Num -> Float
    function hTan               ();                        # :: Num -> Float
    function hypot              (Num &$n);                 # :: (Num, Num) -> Float
    function isFinite           ();                        # :: Num -> Bool
    function isInfinite         ();                        # :: Num -> Bool
    function isNAN              ();                        # :: Num -> Bool
    function log10              ();                        # :: Num -> Float
    function log1p              ();                        # :: Num -> Float
    function log                (Num &$n); # $n = M_E      # :: (Num, Num) -> Float
    function mod                (Num &$n);                 # :: (Num, Num) -> Float
    function mtRandUntil        (Num &$n); # $n = MT_RAND_MAX  # :: (Num, Num) -> Int
    function mul                (Num &$n);                 # :: (Num, Num) -> Num
    function pow                (Num &$n);                 # :: (Num, Num) -> Num
    function radToDeg           ();                        # :: Num -> Float
    function randUntil          (Num &$n); # $n = RAND_MAX  # :: (Num, Num) -> Int
    function round              (Int &$n, Int &$o); # $n = 0, $o = PHP_ROUND_HALF_UP # :: (Num, Int, Int) -> Float
    function sin                ();                        # :: Num -> Float
    function sqrt               ();                        # :: Float -> Float
    function sub                (Num &$n);                 # :: (Num, Num) -> Num
    function tan                ();                        # :: Num -> Float
  }