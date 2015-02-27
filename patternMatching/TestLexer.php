<?php
  require_once "Tokenizer.php";
  require_once "Token.php";
  require_once "Assertion.php";

  class TestLexer {
    function __construct($args) {
      $lexer = new Tokenizer($args);
      $token = $lexer->nextToken();

      while ($token->type != 1) {
        echo $token . "\n";
        $token = $lexer->nextToken();
      }
    }
  }

  new TestLexer("Either (Error _) (Str name)");
