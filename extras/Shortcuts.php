<?php
  function boolean($v) {
    return new Boolean($v);
  }

  function collection($v) {
    return new Collection($v);
  }

  function integer($v) {
    return new Integer($v);
  }

  function loop() {
    return new Loop; 
  }

  function string($v) {
    return new String($v);
  }