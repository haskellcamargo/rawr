Rawr documentation
====

**Rawr**: A word that means "I Love You" in dinosaur.

### What is Rawr?

Rawr is a powerful PHP library written to implement static typing in the language. It offers many improvements in the language and, by compatibility questions, works by inclusion. It also contains a package manager to really separate the things and functional programming becomes easier. Also, it has integration with a port of `Prelude-LS`, called `Prelude-PHP`. It also adds the power of tables and mappings to manage data, allowing a much more expressive code than PHP can currently do.

With Rawr, you can have:

- Static Typing
- Monads
- Enumerators
- JS-like Objects
- Prototype-based-programming
- Method-chaining
- Package manager
- Function autoloading

## Installation and Introduction

To install Rawr, just download the files and use `include_once` in the file `./src/rawr.php`. Maybe, if you want make a test, try the simple `Hello World!`:

```php
<?php

include_once './src/rawr.php';

$main = (new String ("Hello World!"))
        -> putStrLn();
```

Your output in the screen should be "Hello World!". Please, not also that the data is **imutable**. You can't just reassign the value of that string without dispose the object and redefine it as a **new string**. Are you a liar to change its value after you say it receives that value? There is also an alternative syntax for defining a new string:

```php
<?php

$main = (& string ("Hello World!"))
        -> putStrLn();
```

Rawr also implements the power of method-chaining. A solid example in LiveScript of piping and method chaining can be this:

```livescript
a = [2 7 1 8]
  ..push 3
  ..shift!
  ..sort!
  
a #=> [1, 3, 7, 8]
```
The same can be made with Rawr in the following manner:

```php
<?php

$a = new Collection(2, 7, 1, 8);
$a -> push  (3)
   -> shift ()
   -> sort  (); #=> [1, 3, 7, 8]
```

## Types are now objects

Absolutely forget all you know about typing in PHP. Rawr implements static typing and has, by default, the following types as "primitives", but that, when instantiateds, are objects that can dispatch messages and make the communication possible: `Boolean`, `Integer`, `String`, `Char`, `Float`, `Double`, `Object`, `Collection`, `Either`, `Enum`, `Table`, `Mapping` and `Func` and allows you to work with constraints and also has dataflow programming concepts. This document will give you a demo of how to use each of them.

### Integer

Accepts values that are truly PHP integers or it can use type-inference to check the type and try to cast to an integer. All the default methods applied to integers can be chained. You can also try to call extension methods to cast it to another object type:

```php
<?php

$myInt = (new Integer (100))
         -> doubleMe ()         #=> Object integer 200
         -> add      (10)       #=> Object integer 210
         -> sqrt     ()         #=> Object float 14.4913767
         -> toInteger();        #=> Object integer 14
         
$myInt   -> toString()
         -> putStrLn();
```

You can also specify that a function must receive a statically defined object as a parameter:

```php
<?php

$add = function (Integer $x, Integer $y) {
  return $x -> add ($y);
};
```

And be specific in your constraints! Limit the exactly range that it can receive, in case of mutable variables.

```php
<?php

$myUInt = new Integer (Maybe :: mutable, & constraint (Constr :: unsigned));
$myAgeInt = new Integer (Maybe :: mutable, & constraint ('18 .. 115'));
$myEvenInt = new Integer (Maybe :: mutable, & constraint (Constr :: even));


$myUInt    -> let (10); # Pass
$myAgeInt  -> let (21); # Pass
$myEvenInt -> let (2)   # Pass
           -> let (4)   # Pass
           -> let (5);  # Exception thrown
```
