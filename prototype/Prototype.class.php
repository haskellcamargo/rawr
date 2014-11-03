<?php
/**
* Prototype - Simple prototype-based programming in PHP
*
* @author Tasso Evangelista <tassoevan@tassoevan.me>
* @copyright 2013 Tasso Evangelista
* @link http://github.com/tassoevan/prototype
* @license http://github.com/tassoevan/prototype/LICENSE
* @version 1.2.2
* @package Prototype
*
* MIT LICENSE
*
* Permission is hereby granted, free of charge, to any person obtaining
* a copy of this software and associated documentation files (the
* "Software"), to deal in the Software without restriction, including
* without limitation the rights to use, copy, modify, merge, publish,
* distribute, sublicense, and/or sell copies of the Software, and to
* permit persons to whom the Software is furnished to do so, subject to
* the following conditions:
*
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
* MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
* LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
* OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
* WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/**
 * The <code>Prototype</code> class represents objects that hava properties dinamicly modified.
 * @author Tasso Evangelista
 */
class Prototype implements \ArrayAccess
{
  private static $accessClosures;

  /**
   * Initialize the internal access closures, used to get, set and call properties from prototypes
   */
  private static function initiliazeAccessClosures()
  {
    if ( empty(self::$accessClosures) ) {
      self::$accessClosures = array(
        'normal' => array(
          'get' => function(\Prototype $obj, &$value) {
            return $value;
          },
          'set' => function(\Prototype $obj, &$variable, &$value) {
            $variable = $value;
          },
          'call' => function(\Prototype $obj, $propertyName, &$value, array &$args) {
            if ( $value instanceof \Closure || $value instanceof \Prototype )
              return call_user_func_array($value, $args);
            else
              throw new BadMethodCallException(sprintf('%s is not a closure or prototype', $propertyName));
          }
        ),

        'dynamic' => array(
          'get' => function(\Prototype $obj, &$value) {
            $closure = &$value[0];

            if ( $closure instanceof \Closure )
              return $closure();
            else
              return null;
          },
          'set' => function(\Prototype $obj, &$variable, &$value) {
            $closure = $variable[1];
            if ( $closure instanceof \Closure )
              $closure($value);
          },
          'call' => function(\Prototype $obj, $propertyName, &$value, array &$args) {
            if ( $value[2] instanceof \Closure || $value[2] instanceof \Prototype )
              return call_user_func_array($value[2], $args);
            else
              throw new BadMethodCallException(sprintf('%s is not closure or prototype', $propertyName));
          }
        ),

        'lazy' => array(
          'get' => function(\Prototype $obj, &$value) {
            if ( $value instanceof \Closure )
              $value = array($value());
            
            return $value[0];
          },
          'set' => function(\Prototype $obj, &$variable, &$value) {
            $variable = array($value);
          },
          'call' => function(\Prototype $obj, $propertyName, &$value, array &$args) {
            if ( $value instanceof \Closure || $value instanceof \Prototype )
              $value = array($value);

            if ( $value[0] instanceof \Closure || $value[0] instanceof \Prototype )
              return call_user_func_array($value[0], $args);
            else
              throw new BadMethodCallException(sprintf('%s is not closure or prototype', $propertyName));
          }
        )
      );
    }
  }

  /**
   * Returns a pair containing <code>normal</code> access closures and the value.
   * <code>Normal</code> access closures performs simple data storage
   * @param mixed $value
   * @return array
   */
  public static function normal($value)
  {
    self::initiliazeAccessClosures();
    return array(self::$accessClosures['normal'], $value);
  }

  /**
   * Returns a pair containing <code>dynamic</code> access closures and the value.
   * <code>Dynamic</code> access closures always execute the passed <code>get</code>,
   * <code>set</code> and <code>call</code> closures/prototypes for dynamic value
   * creation, value storage and function call, respectively
   * @param Closure|Prototype $get
   * @param Closure|Prototype $set
   * @param Closure|Prototype $call
   * @return array
   */
  public static function dynamic($get, $set = null, $call = null)
  {
    self::initiliazeAccessClosures();
    return array(self::$accessClosures['dynamic'], array($get, $set, $call));
  }

  /**
   * Returns a pair containing <code>lazy</code> access closures and the value.
   * <code>lazy</code> access closures grants that stored data only will be
   * generated on first access to property, performing lazy loading
   * @param Closure $generator
   * @return array
   */
  public static function lazy(\Closure $generator)
  {
    self::initiliazeAccessClosures();
    return array(self::$accessClosures['lazy'], $generator);
  }

  /**
   * Constructs a closure for a generic callable
   * @param callable $callable
   * @return Closure
   */
  public static function closure($callable)
  {
    return function() use($callable) {
      return call_user_func_array($callable, func_get_args());
    };
  }

  /**
   * Creates a array of data generated by iterate over prototype properties
   * @param Prototype $prototype
   * @return array
   */
  public static function data(Prototype $prototype)
  {
    $ret = array();

    foreach ( $prototype->properties as $key => $value )
      $ret[$key] = $prototype->offsetGet($key);

    return $ret;
  }

  private $invokable;
  private $properties = array();

  /**
   * Constructs a new Prototype instance. If a closure is provided, the own prototype becomes callable via __invoke() method.
   * @param Closure|null $invokable the closure that may be invoked
   */
  public function __construct(\Closure $invokable = null)
  {
    self::initiliazeAccessClosures();
    $this->invokable = $invokable;
  }

  /**
   * @see ArrayAccess::offsetExists()
   */
  public function offsetExists($propertyName)
  {
    return isset($this->properties[$propertyName]);
  }

  /**
   * @see ArrayAccess::offsetUnset()
   */
  public function offsetUnset($propertyName)
  {
    unset($this->properties[$propertyName]);
  }

  /**
   * @see ArrayAccess::offsetGet()
   */
  public function offsetGet($propertyName)
  {
    $accessClosure = $this->properties[$propertyName][0]['get'];
    return $accessClosure($this, $this->properties[$propertyName][1]);
  }

  /**
   * @see ArrayAccess::offsetSet()
   */
  public function offsetSet($propertyName, $value)
  {
    $valueIsPrototypeSet = is_array($value) && count($value) == 2 && isset($value[0]) && in_array($value[0], self::$accessClosures, true);

    if ( $valueIsPrototypeSet )
      $this->properties[$propertyName] = $value;
    elseif ( isset($this->properties[$propertyName]) ) {
      $accessClosure = &$this->properties[$propertyName][0]['set'];
      $accessClosure($this, $this->properties[$propertyName][1], $value);
    }
    else
      $this->properties[$propertyName] = Prototype::normal($value);
  }

  /**
   * @see __isset()
   */
  public function __isset($propertyName)
  {
    return $this->offsetExists($propertyName);
  }

  /**
   * @see __unset()
   */
  public function __unset($propertyName)
  {
    $this->offsetUnset($propertyName);
  }

  /**
   * @see __get()
   */
  public function __get($propertyName)
  {
    return $this->offsetGet($propertyName);
  }

  /**
   * @see __set()
   */
  public function __set($propertyName, $value)
  {
    $this->offsetSet($propertyName, $value);
  }

  /**
   * @see __call()
   */
  public function __call($propertyName, array $args)
  {
    $accessClosure = &$this->properties[$propertyName][0]['call'];

    if ( !isset($accessClosure) )
      throw new BadMethodCallException(sprintf('%s is undefined', $propertyName));

    return $accessClosure($this, $propertyName, $this->properties[$propertyName][1], $args);
  }

  /**
   * @see __invoke()
   */
  public function __invoke()
  {
    if ( $this->invokable instanceof \Closure )
      return call_user_func_array($this->invokable, func_get_args());
    else
      throw new BadMethodCallException('Prototype is not invokable');
  }
}