<?php

require "../src/DataType/Type.php";
require "../src/DataType/Bool.php";

use \Rawr\DataType\Bool;

class BoolTest extends PHPUnit_Framework_TestCase
{
  public $a;
  public $b;
  public $c;

  public function testConstruct()
  {
    $this->a = new Bool(true);
    $this->b = new Bool(true);
    $this->c = new Bool(false);
  }

  public function testAnd()
  {
    $result = [
      0 => (new Bool(true))->_and(new Bool(true)),
      1 => (new Bool(false))->_and(new Bool(true))
    ];

    $this->assertEquals(new Bool(true), $result[0]);
    $this->assertEquals(new Bool(false), $result[1]);
  }

  public function testOr()
  {
    $result = [
      0 => (new Bool(true))->_or(new Bool(true)),
      1 => (new Bool(false))->_or(new Bool(true)),
      2 => (new Bool(false))->_or(new Bool(false))
    ];
    
    $this->assertEquals(new Bool(true), $result[0]);
    $this->assertEquals(new Bool(true), $result[1]);
    $this->assertEquals(new Bool(false), $result[2]);
  }

  public function testDiff()
  {
    $result = [
      0 => (new Bool(true))->diff(new Bool(true)),
      1 => (new Bool(false))->diff(new Bool(true)),
    ];
    
    $this->assertEquals(new Bool(false), $result[0]);
    $this->assertEquals(new Bool(true), $result[1]);
  }

  public function testEq()
  {
    $result = [
      0 => (new Bool(true))->eq(new Bool(true)),
      1 => (new Bool(false))->eq(new Bool(true)),
    ];
    
    $this->assertEquals(new Bool(true), $result[0]);
    $this->assertEquals(new Bool(false), $result[1]);
  }

  public function testGt()
  {
    $result = [
      0 => (new Bool(true))->gt(new Bool(true)),
      1 => (new Bool(false))->gt(new Bool(true)),
    ];
    
    $this->assertEquals(new Bool(false), $result[0]);
    $this->assertEquals(new Bool(false), $result[1]);
  }

  public function testGtOrEq()
  {
    $result = [
      0 => (new Bool(true))->gtOrEq(new Bool(true)),
      1 => (new Bool(false))->gtOrEq(new Bool(true)),
    ];
    
    $this->assertEquals(new Bool(true), $result[0]);
    $this->assertEquals(new Bool(false), $result[1]);
  }

  public function testLt()
  {
    $result = [
      0 => (new Bool(true))->lt(new Bool(true)),
      1 => (new Bool(false))->lt(new Bool(true)),
    ];
    
    $this->assertEquals(new Bool(false), $result[0]);
    $this->assertEquals(new Bool(true), $result[1]);
  }

  public function testLtOrEq()
  {
    $result = [
      0 => (new Bool(true))->ltOrEq(new Bool(true)),
      1 => (new Bool(false))->ltOrEq(new Bool(true)),
    ];
    
    $this->assertEquals(new Bool(true), $result[0]);
    $this->assertEquals(new Bool(true), $result[1]);
  }
}