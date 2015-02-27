<?php
  require_once "Lexer.php";

  class Tokenizer extends Lexer {
    const T_OBJ        = 2;
    const T_VAR        = 3;
    const T_WILDCARD   = 4;
    const T_LPAREN     = 5;
    const T_RPAREN     = 6;
    static $tokenNames = [
      "n/a", "<EOF>", "T_OBJ", "T_VAR", "T_WILDCARD", "T_LPAREN", "T_RPAREN"
    ];

    function getTokenName($name) {
      return self :: $tokenNames[$name];
    }

    function __construct($input) {
      parent :: __construct($input);
    }

    function nextToken() {
      while ($this->char != self :: EOF) {
        switch ($this->char) {
          case " ":
          case "\t":
          case "\n":
          case "\r":
            $this->whitespace();
            continue;
          case "(":
            $this->consume();
            return new Token(self :: T_LPAREN, "(");
          case ")":
            $this->consume();
            return new Token(self :: T_RPAREN, ")");
          case "_":
            $this->consume();
            return new Token(self :: T_WILDCARD, "_");
          default:
            if (Assertion :: isUpper($this->char)) {
              return $this->T_OBJ();
            }
            else if (Assertion :: isLower($this->char)) {
              return $this->T_VAR();
            }

            throw new Exception("Invalid character: "
              . $this->char);
        }
      }
      return new Token(self :: EOF_TYPE, "<EOF>");
    }

    function whitespace() {
      while (ctype_space($this->char))
        $this->consume();
    }

    function T_OBJ() {
      $acc = $this->char;
      $this->consume();
      while (Assertion :: isLetter($this->char)) {
        $acc .= $this->char;
        $this->consume();
      }
      return new Token(self :: T_OBJ, $acc);
    }

    function T_VAR() {
      $acc = $this->char;
      $this->consume();
      while (Assertion :: isLetter($this->char)) {
        $acc .= $this->char;
        $this->consume();
      }
      return new Token(self :: T_VAR, $acc);
    }
  }
