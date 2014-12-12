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

  require_once 'Data.Contract.INum.php';

  # Parent class for Real and Int.
  # This class knows how to choose between the types according
  # to the correct occasion.
  # Numeric types might extend it.

  class Num extends DataTypes implements Contract\INum {

    public function __construct($val) { # :: a -> a
      # We expect $val to be a numeric value.
      if (is_numeric($val)) {
        #parent :: __construct();
        $this->value = $val;
      }
      else 
        throw new Exception("Expecting `{$val}` to be a valid number. Received " . gettype($val));
      return $this;
    }

    # Absolute value.
    public function abs() { # :: a -> Number
      return new Num(abs($this->value));
    }

    # Arc cosin.
    public function arc_cos() { # :: Float -> Float
      return new Num\Float(acos($this->value));
    }

    # Adds $value to the number.
    public function add($value) { # :: (Float, Float) -> Float
      return new Num\Float($this->value + TypeInference :: to_primitive($value));
    }

    # Arc sin.
    public function arc_sin() { # :: Float -> Float
      return new Num\Float(asin($this->value));
    }

    # Arc tangent of 2 values.
    public function arc_tan2($input) { # :: (Float -> Float) -> Float
      return new Num\Float(
        atan2($this->value, TypeInference :: to_primitive($input)));
    }

    # Arc tangent.
    public function arc_tan() { # :: Float -> Float
      return new Num\Float(atan($this->value));
    }

    # Round fractions up.
    public function ceil() { # :: Float -> Float
      return new Num\Float(ceil($this->value));
    }

    # Cosin.
    public function cos() { # :: Float -> Float
      return new Num\Float(cos($this->value));
    }

    # Dregrees to radians.
    public function deg_to_rad() { # :: Float -> Float
      return new Num\Float(deg2rad($this->value));
    }

    # Divides by $value.
    public function div($value) { # :: (Float, Float) -> Float
      return new Num\Float($this->value / TypeInference :: to_primitive($value));
    }

    # Calculates the exponent of e.
    public function exp() { # :: Float -> Float
      return new Num\Float(exp($this->value));
    }

    # Returns exp(Number) - 1, computed in a way that is accurate even
    # when the value of number is close to zero.
    public function expm1() { # :: Float -> Float
      return new Num\Float(expm1($this->value));
    }

    # Round fractions down.
    public function floor() { # :: Float -> Float
      return new Num\Float(floor($this->value));
    }

    # Greater than.
    public function gt($input) { # :: (Float, Float) -> Bool
      return new Bool($this->value > TypeInference :: to_primitive($input));
    }

    # Hyperbolic arc cosin,
    public function h_arc_cos() { # :: Float -> Float
      return new Num\Float(acosh($this->value));
    }

    # Hyperbolic arc sin.
    public function h_arc_sin() { # :: Float -> Float
      return new Num\Float(asinh($this->value));
    }

    # Hyperbolic arc tangent.
    public function h_arc_tan() { # :: Float -> Float
      return new Num\Float(atanh($this->value));
    }

    # Hyperbolic cosin.
    public function h_cos() { # :: Float -> Float
      return new Num\Float(cosh($this->value));
    }

    # Hyperbolic sin.
    public function h_sin() { # :: Float -> Float
      return new Num\Float(sinh($this->value));
    }

    # Hyperbolic tangent.
    public function h_tan() { # :: Float -> Float
      return new Num\Float(tanh($this->value));
    }

    # Returns the hypotenuse of a triangle.
    public function hypot($value) { # :: (Float, Float) -> Float
      return new Num\Float(hypot($this->value, TypeInference :: to_primitive($value)));
    }

    # Returns a boolean saying if the number is finite.
    public function is_finite() { # :: Float -> Bool
      return new Bool(is_finite($this->value));
    }
    
    # Returns a boolean saying if the number is infinite.
    public function is_infinite() { # :: Float -> Bool
      return new Bool(is_infinite($this->value));
    }

    # Returns true if the valus is not a number.
    public function is_nan() { # :: Float -> Bool
      return new Bool(is_nan($this->value));
    }

    # Base 10 logarithm.
    public function log10() { # :: Float -> Float
      return new Num\Float(log10($this->value));
    }

    # Returns log(1 + Number), computed in a way that is accurate even
    # when the value of number is close to zero.
    public function log1p() { # :: Float -> Float
      return new Num\Float(log1p($this->value));
    }

    # Natural logarithm.
    public function log($value = M_E) { # :: (Float, Maybe Float) -> Float
      return new Num\Float(
        log($this->value, TypeInference :: to_primitive($value)));
    }

    # Less than.
    public function lt($input) { # :: (Float, Float) -> Bool
      return new Bool($this->value < TypeInference :: to_primitive($input));
    }

    # The module of the division.
    public function mod($value) { # (Float, Float) -> Float
      return new Num\Float(fmod($this->value, TypeInference :: to_primitive($value)));
    }

    # Generate a better random value.
    public function mt_rand_until($value = MT_RAND_MAX) { # :: (Int, Maybe Int) -> Int
      return new Num\Int(
        mt_rand($this->value, TypeInference :: to_primitive($value)));
    }

    # Seed the better random number generator.
    public function mt_seed_rand() { # :: Int -> Void
      mt_srand($this->value);
      return new Void;
    }

    # Multiplication by $value.
    public function mul($value) { # :: (Float, Float) -> Float
      return new Num\Float($this->value * TypeInference :: to_primitive($value));
    }

    # Exponential expression.
    public function pow($exp) { # :: (Number, Number) -> Number
      return new Num(pow($this->value, TypeInference :: to_primitive($exp)));
    }

    # Converts the radian number to the equivalent number in degrees.
    public function rad_to_deg() { # :: Float -> Float
      return new Num\Float(rad2deg($this->value));
    }

    # Generate a random integer.
    public function rand_until($value = RAND_MAX) { # :: (Int, Maybe Int) -> Int
      return new Num\Int(
        rand($this->value, TypeInference :: to_primitive($value)));
    }

    # Rounds a float.
    # Uncle Rasmus doesn't allow returned functions to be applied.
    # Some day I'll throw a pie in Lerdorf's face by this.
    # That's why round isn't an unary function.
    public function round($x = 0, $y = PHP_ROUND_HALF_UP) { # :: (Float, Maybe Int, Maybe Int) -> Float
      return new Num\Float(
        round($this->value, 
          TypeInference :: to_primitive($x),
          TypeInference :: to_primitive($y)));
    }

    # Seed the random number generator.
    public function seed_rand() { # :: Int -> Void
      srand($this->value);
      return new Void;
    }

    # Sin.
    public function sin() { # :: Float -> Float
      return new Num\Float(sin($this->value));
    }

    # Square root of the number.
    public function sqrt() { # :: Float -> Float
      return new Num\Float(sqrt($this->value));
    }

    # Subtraction
    public function sub($value) { # :: (Float, Float) -> Float
      return new Num\Float($this->value - TypeInference :: to_primitive($value));
    }

    # Tangent.
    public function tan() { # :: Float -> Float
      return new Num\Float(tan($this->value));
    }

    # Gives a string containing the binary conversion of the number.
    public function to_binary() { # :: Int -> String
      return new String(decbin($this->value));
    }

    # Gives a string containing the hexadecimal value of the number.
    public function to_hex() { # :: Int -> String
      return new String(dechex($this->value));
    }

    # Gives a string containing the octal value of the number.
    public function to_oct() { # :: Int -> String
      return new String(decoct($this->value));
    }
  }