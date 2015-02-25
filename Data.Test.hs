<?php
  require_once "./Data.Types.php";
  use \Data\Str;
  use \Data\Num;
  use \Data\Num\Int;
  use \Data\Num\Float;

  # Testing all methods of Data.Num, Data.Num.Int and Data.Num.Float

  $aGeneric = Num (-10);
  $bGeneric = Num (3.1415);
  $aInteger = Int (1);
  $bInteger = Int (2);
  $aFloat   = Float (3);
  $bFloat   = Float (4);

  $aFloat->add($bFloat)->inspect();
