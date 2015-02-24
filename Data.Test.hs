<?php
  require_once "./Data.Types.php";
  use \Data\Str;
  use \Data\Num;
  use \Data\Num\Int;
  use \Data\Num\Float;

  $tuple = Tuple (Str ("Marcelo Camargo"), Int (10));


  $tuple
  -> showType ()
  -> putStrLn ();


