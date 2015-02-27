<?php
  class Token {
    public $type, $text;

    function __construct($type, $text) {
      list ( $this->type
           , $this->text ) = [$type, $text];
    }

    function __toString() {
      $tname = Tokenizer :: $tokenNames[$this->type];
      return "<'{$this->text}', {$tname}>";
    }
  }
