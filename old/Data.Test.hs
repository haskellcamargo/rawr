<?php
  require_once "./Data.Types.php";
  use \Data\Str;
  use \Data\Num;
  use \Data\Num\Int;
  use \Data\Num\Float;
  use \Data\Either\Right;
  use \Data\Either\Left;
  use \Data\Error;

  $name = Maybe (Str ("marcelo"));

  function dispatchError(Error $err) { $err -> send (); }

  $t = Match ($name) -> with ([
    "Str x" => function($x) { return Str ("Eu te amo, ") -> concat ($x); }
  ]);
