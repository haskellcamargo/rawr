<?php

namespace Rawr\DataType
{
  use \Rawr\DataType\Maybe\Just;
  use \Rawr\DataType\Maybe\Nothing;

  abstract class Maybe extends Type
  {
    /**
     * Equivalent to Haskell's >>= operator. Applies the received function
     * if no errors happen.
     */
    abstract function bind($fn);

    /**
     * Tries to extract an element out of a Just.
     */
    abstract function fromJust();
    
    /**
     * Takes a default value. If this inner value is Nothing, returns the
     * default value, otherwise returns this value extracted.
     */
    abstract function fromMaybe($def);

    /**
     * Checks if the element is a Just.
     */
    abstract function isJust();

    /**
     * Checks if the element is a Nothing.
     */
    abstract function isNothing();

    /**
     * returns the default value or applies the received function.
     */
    abstract function maybe($def, $fn);

    /**
     * Returns an empty list when Nothing and a singleton list when Just.
     */
    abstract function toList();
  }

  function Maybe($value) {
    return is_null($value)
      ? new Nothing
      : new Just($value);
  }
}