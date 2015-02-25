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

    # Absolute value.
    public function abs() { # :: Num -> Num
      # This function always returns a number of the same type of the object
      # that has this behavior.
      $_ = get_class($this);
      return new $_(abs($this->value));
    }

    # Adds a value to a number
    public function add(Num &$n) { # :: (Num a) => (a, a) -> a
      $_ = $this->_return($n->value);
      return new $_($this->value + $n->value);
    }

    # Arc cosin.
    public function arcCos() { # :: Num -> Float
      return new Num\Float(acos($this()));
    }

    # Arc sin.
    public function arcSin() { # :: Num -> Float
      return new Num\Float(asin($this()));
    }

    # Arc tangent of 2 values.
    public function arcTan2(Num &$n) { # :: (Num, Num) -> Float
      return new Num\Float(atan2($this(), $n()));
    }

    # Arc tangent.
    public function arcTan() { # :: Num -> Float
      return new Num\Float(atan($this()));
    }

    # Round fractions up.
    public function ceil() { # :: Num -> Float
      return new Num\Float(ceil($this()));
    }

    # Cosin.
    public function cos() { # :: Num -> Float
      return new Num\Float(cos($this()));
    }

    # Degrees to radians.
    public function degToRad() { # :: Num -> Float
      return new Num\Float(deg2rad($this()));
    }

    # Divides by $value.
    public function div(Num &$n) { # :: (Num, Num) -> Float
      $_ = $this->_return($n());
      return new $_($this() + $n());
    }

    # Calculates the exponent of e.
    public function exp() { # :: Num -> Float
      return new Num\Float(exp($this()));
    }

    # Returns exp(Number) - 1, computed in a way that is accurate even
    # when the value of number is close to zero.
    public function expm1() { # :: Num -> Float
      return new Num\Float(expm1($this()));
    }

    # Round fractions down.
    public function floor() { # :: Num -> Float
      return new Num\Float(floor($this()));
    }

    # Hyperbolic arc cosin,
    public function hArcCos() { # :: Num -> Float
      return new Num\Float(acosh($this()));
    }

    # Hyperbolic arc sin.
    public function hArcSin() { # :: Num -> Float
      return new Num\Float(asinh($this()));
    }

    # Hyperbolic arc tangent.
    public function hArcTan() { # :: Num -> Float
      return new Num\Float(atanh($this()));
    }

    # Hyperbolic cosin.
    public function hCos() { # :: Num -> Float
      return new Num\Float(cosh($this()));
    }

    # Hyperbolic sin.
    public function hSin() { # :: Num -> Float
      return new Num\Float(sinh($this()));
    }

    # Hyperbolic tangent.
    public function hTan() { # :: Num -> Float
      return new Num\Float(tanh($this()));
    }

    # Returns the hypotenuse of a triangle.
    public function hypot(Num &$n) { # :: (Num, Num) -> Float
      return new Num\Float(hypot($this(), $n()));
    }

    # Returns a boolean saying if the number is finite.
    public function isFinite() { # :: Num -> Bool
      return new Bool(is_finite($this()));
    }

    # Returns a boolean saying if the number is infinite.
    public function isInfinite() { # :: Num -> Bool
      return new Bool(is_infinite($this()));
    }

    # Returns true if the valus is not a number.
    public function isNAN() { # :: Num -> Bool
      return new Bool(is_nan($this()));
    }

    # Base 10 logarithm.
    public function log10() { # :: Num -> Float
      return new Num\Float(log10($this()));
    }

    # Returns log(1 + Number), computed in a way that is accurate even
    # when the value of number is close to zero.
    public function log1p() { # :: Num -> Float
      return new Num\Float(log1p($this()));
    }

    # Natural logarithm.
    public function log(Num &$n = Null) { # :: (Num, Num) -> Float
      return new Num\Float(log($this(), $n === Null ? M_E : $n()));
    }

    # The module of the division.
    public function mod(Num &$n) { # (Num, Num) -> Num
      $_ = $this->_return($n());
      return new $_(fmod($this(), $n()));
    }

    # Multiplication.
    public function mul(Num &$n) { # :: (Num, Num) -> Num
      $_ = $this->_return($n());
      return new $_($this() * $n());
    }

    # Returns the negation of the value.
    public function negate() { # :: Num -> Num
      return -$this();
    }

    # Exponential expression.
    public function pow(Num &$n) { # :: (Num, Num) -> Num
      $a = $n === Null ? MT_RAND_MAX : $n();
      $_ = $this->_return($a);
      return new $_(pow($this(), $a));
    }

    # Converts the radian number to the equivalent number in degrees.
    public function radToDeg() { # :: Num -> Float
      return new Num\Float(rad2deg($this()));
    }

    # Generate a random integer.
    public function randUntil(Num &$n = Null) { # :: (Num, Num) -> Int
      $a = $n === Null ? RAND_MAX : $n();
      return new Num\Int(
        rand($this(), $a));
    }

    # Rounds a float.
    # Uncle Rasmus doesn't allow returned functions to be applied.
    # Some day I'll throw a pie in Lerdorf's face by this.
    # That's why round isn't an unary function and will not allow currying.
    public function round(Int &$n = Null, Int &$o = Null) { # :: (Num, Int, Int) -> Float
      return new Num\Float($this(), $n === Null ? 0                 : $n()
                                  , $o === Null ? PHP_ROUND_HALF_UP : $o());
    }

    # Sin.
    public function sin() { # :: Num -> Float
      return new Num\Float(sin($this()));
    }

    # Square root of the number.
    public function sqrt() { # :: Num -> Float
      return new Num\Float(sqrt($this()));
    }

    # Subtraction
    public function sub(Num &$n) { # :: (Num, Num) -> Num
      $_ = $this->_return($n());
      return new $_($this() - $n());
    }

    # Tangent.
    public function tan() { # :: Num -> Float
      return new Num\Float(tan($this()));
    }
  }
