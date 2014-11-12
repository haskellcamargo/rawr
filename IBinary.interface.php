<?php
  interface IBinary {
    public function __construct($val);
    public function toDec();
    public function toHex();
    public function toOct();
  }