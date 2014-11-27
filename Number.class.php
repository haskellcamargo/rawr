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

  require_once 'INumber.interface.php';

  # Parent class for Real and Int.
  # This class knows how to choose between the types according
  # to the correct occasion.
  # Numeric types might extend it.

  class Number extends DataTypes implements INumber {

    # These methods are responsible by, if the variable already is type X, 
    # cast the variable to Y, by returning a new Y. Otherwise change its
    # inner value.
    private function as_int_do($closure, $aux = null) { # (Func, Maybe Float) -> Float
       if (get_class($this) === "Int") {
        $this->value = $aux === null?
          $closure($this->value)
        : $closure($this->value, $aux);
        return $this;
       } else return $aux === null?
          new Int($closure($this->value))
        : new Int($closure($this->value, $aux));
    }

    private function as_real_do($closure, $aux = null) { # (Func, Maybe Float) -> Float
       if (get_class($this) === "Real") {
        $this->value = $aux === null?
          $closure($this->value)
        : $closure($this->value, $aux);
        return $this;
       } else return $aux === null?
          new Real($closure($this->value))
        : new Real($closure($this->value, $aux));
    }

    public function __construct($val) { # a -> a
      # We expect $val to be a numeric value.
      if (is_numeric($val))
        $this->value = $val;
      else throw new Exception("Expecting `{$val}` to be a valid number. Received " . gettype($val));
      return $this;
    }

    # Absolute value.
    public function abs() { # :: a -> Number
      $this->value = abs($this->value);
      return $this;
    }

    # Arc cosin.
    public function arc_cos() { # :: Float -> Float
      return $this
        -> as_real_do('acos');
    }

    # Adds $value to the number.
    public function add($value) { # :: (Float, Float) -> Float
      $this->value += TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Arc sin.
    public function arc_sin() { # :: Float -> Float
      return $this
        -> as_real_do('asin');
    }

    # Arc tangent of 2 values.
    public function arc_tan2($input) { # :: (Float -> Float) -> Float
      return $this
        -> as_real_do('atan2', 
          TypeInference :: to_primitive($input));
    }

    # Arc tangent.
    public function arc_tan() { # :: Float -> Float
      return $this
        -> as_real_do('atan');
    }

    # Round fractions up.
    public function ceil() { # :: Float -> Float
      return $this
        -> as_real_do('ceil');
    }

    # Cosin.
    public function cos() { # :: Float -> Float
      return $this
        -> as_real_do('cos');
    }

    # Dregrees to radians.
    public function deg_to_rad() { # :: Float -> Float
      return $this
        -> as_real_do('deg2rad');
    }

    # Divides by $value.
    public function div($value) { # :: (Float, Float) -> Float
      $this->value /= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Calculates the exponent of e.
    public function exp() { # :: Float -> Float
      return $this
        -> as_real_do('exp');
    }

    # Returns exp(Number) - 1, computed in a way that is accurate even
    # when the value of number is close to zero.
    public function expm1() { # :: Float -> Float
      return $this
        -> as_real_do('expm1');
    }

    # Round fractions down.
    public function floor() { # :: Float -> Float
      return $this
        -> as_real_do('floor');
    }

    # Hyperbolic arc cosin,
    public function h_arc_cos() { # :: Float -> Float
      return $this
        -> as_real_do('acosh');
    }

    # Hyperbolic arc sin.
    public function h_arc_sin() { # :: Float -> Float
      return $this
        -> as_real_do('asinh');
    }

    # Hyperbolic arc tangent.
    public function h_arc_tan() { # :: Float -> Float
      return $this
        -> as_real_do('atanh');
    }

    # Hyperbolic cosin.
    public function h_cos() { # :: Float -> Float
      return $this
        -> as_real_do('cosh');
    }

    # Hyperbolic sin.
    public function h_sin() { # :: Float -> Float
      return $this
        -> as_real_do('sinh');
    }

    # Hyperbolic tangent.
    public function h_tan() { # :: Float -> Float
      return $this
        -> as_real_do('tanh');
    }

    # Returns the hypotenuse of a triangle.
    public function hypot($value) { # :: (Float, Float) -> Float
      $this->value = hypot($this->value, TypeInference :: to_primitive($value));
      return TypeInference :: infer($this);
    }

    # Returns a boolean saying if the number is finite.
    public function is_finite() { # :: Float -> Boolean
      return new Boolean(is_finite($this->value));
    }
    
    # Returns a boolean saying if the number is infinite.
    public function is_infinite() { # :: Float -> Boolean
      return new Boolean(is_infinite($this->value));
    }

    # Returns true if the valus is not a number.
    public function is_nan() { # :: Float -> Boolean
      return new Boolean(is_nan($this->value));
    }

    # Base 10 logarithm.
    public function log10() { # :: Float -> Float
      return $this
        -> as_real_do('log10');
    }

    # Returns log(1 + Number), computed in a way that is accurate even
    # when the value of number is close to zero.
    public function log1p() { # :: Float -> Float
      return $this
        -> as_real_do('log1p');
    }

    # Natural logarithm.
    public function log($value = M_E) { # :: (Float, Maybe Float) -> Float
      return $this
        -> as_real_do('log', TypeInference :: to_primitive($value));
    }

    # The module of the division.
    public function mod($value) { # (Float, Float) -> Float
      if (get_class($value) === "Real")
        $this->value = fmod($this->value, TypeInference :: to_primitive($value));
      else # Manual implementation of operator overloading.
        $this->value = $this->value % TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Generate a better random value.
    public function mt_rand_until($value = MT_RAND_MAX) { # :: (Int, Maybe Int) -> Int
      return $this
        -> as_int_do('mt_rand', TypeInference :: to_primitive($value));
    }

    # Seed the better random number generator.
    public function mt_seed_rand() { # :: Int -> Void
      mt_srand(TypeInference :: to_primitive($this->value));
      return $this;
    }

    # Multiplication by $value.
    public function mul($value) { # :: (Float, Float) -> Float
      $this->value *= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Exponential expression.
    public function pow($exp) { # :: (Number, Number) -> Number
      $this->value = pow($this->value, TypeInference :: to_primitive($exp));
      return TypeInference :: infer($this);
    }

    # Converts the radian number to the equivalent number in degrees.
    public function rad_to_deg() { # :: Float -> Float
      return $this
        -> as_real_do('rad2deg');
    }

    # Generate a random integer.
    public function rand_until($value = RAND_MAX) { # :: (Int, Maybe Int) -> Int
      return $this
        -> as_int_do('rand', $value);
    }

    # Rounds a float.
    public function round($x = 0, $y = PHP_ROUND_HALF_UP) { # :: (Float, Maybe Int, Maybe Int) -> Float
      if (get_class($this) === "Real") {
        $this->value = round($this->value, 
          TypeInference :: to_primitive($x), 
          TypeInference :: to_primitive($y));
        return $this;
      } else
        return new Real(round($this->value, $x, $y));
    }

    # Seed the random number generator.
    public function seed_rand() { # :: Int -> Void
      srand($this->value);
      return $this;
    }

    # Sin.
    public function sin() { # :: Float -> Float
      return $this
        -> as_real_do('sin');
    }

    # Square root of the number.
    public function sqrt() { # :: Float -> Float
      return new Real(sqrt($this->value));
    }

    # Subtraction
    public function sub($value) { # :: (Float, Float) -> Float
      $this->value -= TypeInference :: to_primitive($value);
      return TypeInference :: infer($this);
    }

    # Tangent.
    public function tan() { # :: Float -> Float
      return $this
        -> as_real_do('tan');
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