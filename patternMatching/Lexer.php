<?php
  abstract class Lexer {
    const EOF        = -1;
    const EOF_TYPE   =  1;
    protected $input
            , $pos   = 0
            , $char;

    function __construct($input) {
      $this->input = $input;
      $this->char  = $this->input[$this->pos];
    }

    function consume() {
      $this->pos++;
      if ($this->pos >= strlen($this->input))
        $this->char = self :: EOF;
      else
        $this->char = $this->input[$this->pos];
    }

    abstract function nextToken();
    abstract function getTokenName($type);
  }
