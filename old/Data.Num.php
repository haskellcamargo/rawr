<?php
  # @author        => Marcelo Camargo
  # @contributors  => []
  # @creation_date => Unkown
  # @last_changed  => 2015-02-24
  # @package       => Data.Num

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
  use \Data\Contract\INum as INum;
  use \Exception;

  # This function is responsible by inference in numeric values. It is able to
  # return the value wrapped in the best type that it can determine for it.
  # Only numeric values are accepted.
  function Num($v) {
    switch (gettype($v)) {
      case "int":
      case "integer":
        return Int($v);
      case "float":
      case "double":
      case "real":
        return Float($v);
      default:
        throw new Exception("Expecting `{$val}` to be a valid number. Received "
          . gettype($val));
    }
  }

  # The `Num` type holds numeric values. By default, `Int` and `Float` types
  # inherit from it. All basic operations that can be applied for both numeric
  # types are defined in this type.
  abstract class Num extends DataTypes {
    # Type rules are here specified.
    # PHP has variable variables, therefore, we just
    # return a primitive string saying the type we want
    # to return and after we search on classes where a class
    # is defined with the same name of the string and we make
    # a new instance of them to return.
    private function _return($operand) {
      if (($type = gettype($this->value)) === gettype($operand)) {
        switch ($type) {
          case "float":
          case "double":
          case "real":
            return "\\Data\\Num\\Float";
          case "int":
          case "integer":
            return "\\Data\\Num\\Int";
        }
      } else {
        $source = is_double($operand) ? "Data.Num.Float" : "Data.Num.Int";
        $target = str_replace('\\', '.', get_class($this));
        throw new \Exception(
          "Cannot implicity convert \"{$target}\" to \"{$source}\".");
      }
    }

    # Returns the absolute value of a number.
    function abs() { # :: Num -> Num
      # This function always returns a number of the same type of the object
      # that has this behavior.
      $_ = get_class($this);
      return new $_(abs($this->value));
    }

    # Adds a value to a number.
    function add(Num &$n) { # :: (Num a) => (a, a) -> a
      $_ = $this->_return($n->value);
      return new $_($this->value + $n->value);
    }

    # Arc cosin.
    function arcCos() { # :: Num -> Float
      return new Num\Float(acos($this->value));
    }

    # Arc sin.
    function arcSin() { # :: Num -> Float
      return new Num\Float(asin($this->value));
    }

    # Arc tangent of 2 values.
    function arcTan2(Num &$n) { # :: (Num, Num) -> Float
      return new Num\Float(atan2($this->value, $n->value));
    }

    # Arc tangent.
    function arcTan() { # :: Num -> Float
      return new Num\Float(atan($this->value));
    }

    # Round fractions up.
    function ceil() { # :: Num -> Float
      return new Num\Float(ceil($this->value));
    }

    # Cosin.
    function cos() { # :: Num -> Float
      return new Num\Float(cos($this->value));
    }

    # Degrees to radians.
    function degToRad() { # :: Num -> Float
      return new Num\Float(deg2rad($this->value));
    }

    # Divides by the parameter.
    function div(Num &$n) { # :: (Num, Num) -> Float
      $_ = $this->_return($n());
      return new $_($this->value / $n->value);
    }

    # Calculates the exponent of e.
    function exp() { # :: Num -> Float
      return new Num\Float(exp($this->value));
    }

    # Returns exp(Number) - 1, computed in a way that is accurate even
    # when the value of number is close to zero.
    function expm1() { # :: Num -> Float
      return new Num\Float(expm1($this->value));
    }

    # Round fractions down.
    function floor() { # :: Num -> Float
      return new Num\Float(floor($this->value));
    }

    # Hyperbolic arc cosin,
    function hArcCos() { # :: Num -> Float
      return new Num\Float(acosh($this->value));
    }

    # Hyperbolic arc sin.
    function hArcSin() { # :: Num -> Float
      return new Num\Float(asinh($this->value));
    }

    # Hyperbolic arc tangent.
    function hArcTan() { # :: Num -> Float
      return new Num\Float(atanh($this->value));
    }

    # Hyperbolic cosin.
    function hCos() { # :: Num -> Float
      return new Num\Float(cosh($this->value));
    }

    # Hyperbolic sin.
    function hSin() { # :: Num -> Float
      return new Num\Float(sinh($this->value));
    }

    # Hyperbolic tangent.
    function hTan() { # :: Num -> Float
      return new Num\Float(tanh($this->value));
    }

    # Returns the hypotenuse of a triangle.
    function hypot(Num &$n) { # :: (Num, Num) -> Float
      return new Num\Float(hypot($this->value, $n->value));
    }

    # Returns a boolean saying if the number is finite.
    function isFinite() { # :: Num -> Bool
      return new Bool(is_finite($this->value));
    }

    # Returns a boolean saying if the number is infinite.
    function isInfinite() { # :: Num -> Bool
      return new Bool(is_infinite($this->value));
    }

    # Returns true if the valus is not a number.
    function isNAN() { # :: Num -> Bool
      return new Bool(is_nan($this->value));
    }

    # Base 10 logarithm.
    function log10() { # :: Num -> Float
      return new Num\Float(log10($this->value));
    }

    # Returns log(1 + Number), computed in a way that is accurate even
    # when the value of number is close to zero.
    function log1p() { # :: Num -> Float
      return new Num\Float(log1p($this->value));
    }

    # Natural logarithm.
    function log(Num &$n = Null) { # :: (Num, Num) -> Float
      return new Num\Float(log($this->value, $n === Null ? M_E : $n()));
    }

    # The module of the division.
    function mod(Num &$n) { # (Num, Num) -> Num
      $_ = $this->_return($n());
      return new $_(fmod($this->value, $n()));
    }

    # Multiplication.
    function mul(Num &$n) { # :: (Num, Num) -> Num
      $_ = $this->_return($n());
      return new $_($this->value * $n->value);
    }

    # Returns the negation of the value.
    function negate() { # :: Num -> Num
      return -$this->value;
    }

    # Exponential expression.
    function pow(Num &$n) { # :: (Num, Num) -> Num
      $_ = $this->_return($n->value);
      return new $_(pow($this->value, $a));
    }

    # Converts the radian number to the equivalent number in degrees.
    function radToDeg() { # :: Num -> Float
      return new Num\Float(rad2deg($this->value));
    }

    # Generate a random integer.
    function randUntil(Num &$n) { # :: (Num, Num) -> Int
      return new Num\Int(rand($this->value, $$n->value));
    }

    # Rounds a float.
    # Uncle Rasmus doesn't allow returned functions to be applied.
    # Some day I'll throw a pie in Lerdorf's face by this.
    # That's why round isn't an unary function and will not allow currying.
    function round(Int &$n = Null, Int &$o = Null) {
    # :: (Num, Int, Int) -> Float
      return new Num\Float(
        round($this->value
            , $n === Null ? 0 /* otherwise */ : $n->value
            , $o === Null ? PHP_ROUND_HALF_UP : $o->value));
    }

    # Sin.
    function sin() { # :: Num -> Float
      return new Num\Float(sin($this->value));
    }

    # Square root of the number.
    function sqrt() { # :: Num -> Float
      return new Num\Float(sqrt($this->value));
    }

    # Subtraction
    function sub(Num &$n) { # :: (Num, Num) -> Num
      $_ = $this->_return($n());
      return new $_($this->value - $n->value);
    }

    # Tangent.
    function tan() { # :: Num -> Float
      return new Num\Float(tan($this->value));
    }
  }
