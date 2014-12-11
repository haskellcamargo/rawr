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

  # Break here: http://php.net/manual/en/function.atan2.php

  # Please, somebody, put this in alphabetic order!
  # I have obsessive compulsive disorder and I can't see this way!
  # Redefine types definition correctly, like PHP documentation does.

  namespace Data\Contract;

  interface INum {
    public function abs();                                        # :: a -> Number
    public function arc_cos();                                    # :: Float -> Float
    public function add($x);                                      # :: (Float, Float) -> Float
    public function arc_sin();                                    # :: Float -> Float
    public function arc_tan2($x);                                 # :: (Float, Float) -> Float
    public function arc_tan();                                    # :: Float -> Float
    public function ceil();                                       # :: Float -> Float
    public function cos();                                        # :: Float -> Float
    public function deg_to_rad();                                 # :: Float -> Float
    public function div($x);                                      # :: (Float, Float) -> Float
    public function exp();                                        # :: Float -> Float
    public function expm1();                                      # :: Float -> Float
    public function floor();                                      # :: Float -> Float
    public function h_arc_cos();                                  # :: Float -> Float
    public function h_arc_sin();                                  # :: Float -> Float
    public function h_arc_tan();                                  # :: Float -> Float
    public function h_cos();                                      # :: Float -> Float
    public function h_sin();                                      # :: Float -> Float
    public function h_tan();                                      # :: Float -> Float
    public function hypot($x);                                    # :: (Float, Float) -> Float
    public function is_finite();                                  # :: Float -> Bool
    public function is_infinite();                                # :: Float -> Bool
    public function is_nan();                                     # :: Float -> Bool
    public function log10();                                      # :: Float -> Float
    public function log1p();                                      # :: Float -> Float
    public function log($y = M_E);                                # :: (Float, Maybe Float) -> Float
    public function mod($x);                                      # :: (Float, Float) -> Float
    public function mt_rand_until($x = MT_RAND_MAX);              # :: (Int, Maybe Int) -> Int
    public function mt_seed_rand();                               # :: Maybe Int -> Void
    public function mul($x);                                      # :: (Float, Float) -> Float
    public function pow($x);                                      # :: (Number, Number) -> Number
    public function rad_to_deg();                                 # :: Float -> Float
    public function rand_until($y = RAND_MAX);                    # :: (Int, Maybe Int) -> Int
    public function round($x = 0, $y = PHP_ROUND_HALF_UP);        # :: (Float, Maybe Int, Maybe Int) -> Float
    public function seed_rand();                                  # :: Int -> Void   
    public function sin();                                        # :: Float -> Float
    public function sqrt();                                       # :: Float -> Float
    public function sub($x);                                      # :: (Float, Float) -> Float
    public function tan();                                        # :: Float -> Float
    public function to_binary();                                  # :: Int -> String
    public function to_hex();                                     # :: Int -> String
    public function to_oct();                                     # :: Int -> String
  }