<?php

namespace Rawr\DataType
{
  use \Rawr\Core\TypeInference;
  use \Rawr\DataType\Collection;
  use \Rawr\DataType\Maybe;
  use \Exception;

  class Nothing extends Maybe
  {
    public function bind($_)
    {
      return $this;
    }

    public function fromJust()
    {
      throw new Exception;
    }

    public function fromMaybe($def)
    {
      return $def;
    }

    public function isJust()
    {
      return new Bool(false);
    }

    public function isNothing()
    {
      return new Bool(true);
    }

    public function maybe($def, $_)
    {
      return $def;
    }

    public function toList()
    {
      return new Collection([]);
    }
  }
}