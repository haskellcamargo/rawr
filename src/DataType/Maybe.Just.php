<?php

namespace Rawr\DataType
{
  use \Rawr\Core\TypeInference;
  use \Rawr\DataType\Collection;
  use \Rawr\DataType\Maybe;

  class Just extends Maybe
  {
    public function __construct($value)
    {
      $this->value = $value;
    }

    public function bind($fn)
    {
      TypeInference::assertCallable($fn);
      return $fn($this->value);
    }

    public function fromJust()
    {
      return $this->value;
    }

    public function fromMaybe($_)
    {
      return $this->value;
    }

    public function isJust()
    {
      return new Bool(true);
    }

    public function isNothing()
    {
      return new Bool(false);
    }

    public function maybe($_, $fn)
    {
      return $fn($this->value);
    }

    public function toList()
    {
      return new Collection([$this->value]);
    }
  }
}