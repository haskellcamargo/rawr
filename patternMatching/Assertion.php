<?php
  class Assertion {
    static function isLower($char) {
      return $char == strtolower($char);
    }

    static function isUpper($char) {
      return $char == strtoupper($char);
    }
  }
