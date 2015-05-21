<?php

require "../src/Core/TypeInference.php";
require "../src/DataType/Type.php";
require "../src/DataType/Fun.php";
require "../src/DataType/Bool.php";

use \Rawr\DataType\Bool;
use \Rawr\DataType\Fun;

class TestFun extends PHPUnit_Framework_TestCase
{
  public function testConstruct()
  {
    $a = new Fun(function($foo, $bar) { });
    $a("Java", "Perl");
  }

  /**
   * @expectedException Exception
   */
  public function testConstructError()
  {
    new Fun(1);
  }

  public function testInvokeIdMonad()
  {
    $a = new Fun(function() {
      return new Bool(true);
    });

    $this->assertEquals(new Bool(true), $a());
  }

  public function testInvokeAlias()
  {
    $a = new Fun(function() {
      return new Bool(true);
    });

    $this->assertEquals(new Bool(true), $a->invoke());
  }
}