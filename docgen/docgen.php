<?php
  $doc = simplexml_load_file("doc.xml");

  function methodList() use (&$doc) {
    foreach ($doc->list->method as $method)
      echo "\t<li><a href=\"{$method}-method\">{$method}</a></li>\n";
  }
?>
<!DOCTYPE html>
<html charset="utf-8">
  <head>
    <title>Rawr Docs - Data.Bool</title>
    <meta name="charset" content="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/global.css" />
    <link rel="stylesheet" type="text/css" href="../css/gh-fork-ribbon.css">
    <!-- Bootstrap offline -->
    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap-theme.min.css">
    <script type="text/javascript" src="../bootstrap.min.js"></script>
  </head>
  <body>
    <!-- TOP RIGHT RIBBON: START COPYING HERE -->
    <div class="github-fork-ribbon-wrapper right">
        <div class="github-fork-ribbon">
            <a href="https://github.com/haskellcamargo/rawr">Fork me on GitHub</a>
        </div>
    </div>
    <!-- TOP RIGHT RIBBON: END COPYING HERE -->
    <div id="menu-container" class="col-lg-12">
      <div id="main-menu" class="col-lg-offset-2 col-lg-8">
        <a href="../index.html">Home</a>
        <a href="../getting-started.html">Getting Started</a>
        <a href="../examples.html">Examples</a>
        <a href="../download.html">Downloads</a>
        <a href="http://github.com/haskellcamargo/rawr">Github</a>
        <a href="../about.html">About</a>
      </div>
    </div>
    <div id="main-content">
      <div class="col-lg-2 col-lg-offset-2">
        <div class="block">
          <div class="block-title"><h4>Parent</h4></div>
          <ul>
            <li><a href="./Data.Types.html">DataTypes</a></li>
          </ul>
        </div>
        <div class="block">
          <div class="block-title"><h4>Interfaces</h4></div>
          <ul>
            <li><a href="./Data.Contract.IBool.html">IBool</a></li>
          </ul>
        </div>
        <div class="block">
          <div class="block-title"><h4>Typeclasses</h4></div>
          <ul>
            <li><a href="#">Eq</a></li>
            <li><a href="#">Ord</a></li>
            <li><a href="#">Show</a></li>
          </ul>
        </div>
        <div class="block">
          <div class="block-title"><h4>Methods</h4></div>
          <ul>

          </ul>
        </div>
      </div>
      <div class="col-lg-6 readable-content">
        <h2>Data.Bool Class</h2>
        <h3>Description</h3>
        <p>The <code>Data.Bool</code> class is responsible for the handling of boolean values, that can be PHP-defined
          constants <code>True</code> and <code>False</code>.</p>
        <p>In <code>\Data\Bool</code> namespace.</p>
        <h3>Aliases</h3>
<pre><code class="php">use \Data\Bool;

$b1 = new Bool (True);
$b2 = Bool (True);
$b3 = new \Data\Bool (True);
$b4 = Boolean (True);
</code></pre>
      <h3>Methods</h3><br />
      <!-- _and method -->
      <h4 class="type-def" id="_and-method">_and :: (Bool, Bool) -> Bool</h4>
      <p>Returns true if both the value of the object and of the received
        expression are true. Otherwise false.</p>
<pre><code class="php">$bothTrue = Bool (True)
  -> _and (True); # Object (Data\Bool) { value: bool (true) }
$bothFalse = Bool (False)
  -> _and (False); # Object (Data\Bool) { value: bool (false) }
$bothValues = Bool (True)
  -> _and (False); # Object (Data\Bool) { value: bool (false) }
</code></pre><br />
      <!-- _or method -->
      <h4 class="type-def" id="_or-method">_or :: (Bool, Bool) -> Bool</h4>
      <p>Returns true if any of the values, of the object, or of the received
       expression are true. Otherwise false.</p>
<pre><code class="php">$bothTrue = Bool (True)
  -> _or (True); # Object (Data\Bool) { value: bool (true) }
$bothFalse = Bool (False)
  -> _or (False); # Object (Data\Bool) { value: bool (false) }
$bothValues = Bool (True)
  -> _or (False); # Object (Data\Bool) { value: bool (true) }
</code></pre><br />
      <!-- _xor method -->
      <h4 class="type-def" id="_xor-method">_xor :: (Bool, Bool) -> Bool</h4>
      <p>Returns true if only one of the values is true, between the value of the
       object and the received expression. Otherwise false.</p>
<pre><code class="php">$bothTrue = Bool (True)
  -> _xor (True); # Object (Data\Bool) { value: bool (false) }
$bothFalse = Bool (False)
  -> _xor (False); # Object (Data\Bool) { value: bool (false) }
$bothValues = Bool (True)
  -> _xor (False); # Object (Data\Bool) { value: bool (true) }
</code></pre><br />
      <!-- diff method -->
      <h4 class="type-def" id="diff-method">diff :: (Eq a) => (a, a) -> Bool</h4>
      <p>Different of. Requires all the values to be of the same type and derived
       from Eq typeclass.</p>
<pre><code class="php">$bool1   = Bool (True);
$bool2   = Bool (False);
$compare = $bool1
  -> diff ($bool2); # Object (Data\Bool) { value: bool (true) }

$str  = Str ("foo");
$bool = Bool (True);
$compareTypes = $bool
  -> diff ($str); # Exception: Expecting argument to be instance of Data\Bool. Instead got Data\Str.
</code></pre><br />
      <!-- eq method -->
      <h4 class="type-def" id="eq-method">eq :: (Eq a) => (a, a) -> Bool</h4>
      <p>Compares equality. Requires all the values to be of the same type and derived
       from Eq typeclass.</p>
<pre><code class="php">$bool1   = Bool (True);
$bool2   = Bool (False);
$compare = $bool1
  -> eq ($bool2); # Object (Data\Bool) { value: bool (false) }

$str  = Str ("foo");
$bool = Bool (True);
$compareTypes = $bool
  -> eq ($str); # Exception: Expecting argument to be instance of Data\Bool. Instead got Data\Str.
</code></pre><br />
      <!-- greaterOrEq method -->
      <h4 class="type-def" id="greaterOrEq-method">greaterOrEq :: (Eq a, Ord a) => (a, a) -> Bool</h4>
      <p>Returns if the value of this object is greater or equal to the value of received value. Must
       be derived from Ord typeclass and, obviously, derived from Eq typeclass.</p>
<pre><code class="php">Int (1) -> greaterOrEq (Int (10)); # Object (Data\Bool) { value: bool (false) }
Str ('Z') -> greaterOrEq (Str ('Z')); # Object (Data\Bool) { value: bool (true) }
</code></pre><br />
      <!-- greaterThan method -->
      <h4 class="type-def" id="greaterThan-method">greaterThan :: (Ord a) => (a, a) -> Bool</h4>
      <p>Returns if the value of this object is greater than the received object. Deriving Ord.</p>
<pre><code class="php">Int (1) -> greaterThan (Int (1)); # Object (Data\Bool) { value: bool (false) }
Float (10.0) -> greaterThan (8.34); # Object (Data\Bool) { value: bool (true) }
</code></pre><br />
      <!-- ifTrue method -->
      <h4 class="type-def" id="ifTrue-method">ifTrue :: (Bool, Func) </h4>
      <p>The closure passed as parameter is performed if the value of this object is true.</p>
<pre><code class="php">$age = Int (18);                        # Object (Data\Int) { value: int (18) }
$age -> greaterOrEq (18)                # Object (Data\Bool) { value: bool (true) }
     -> ifTrue (function () {
          Str ("You're 18 years old or higher.")
            -> putStrLn ();
        });
</code></pre><br />
      <!-- ifFalse method -->
      <h4 class="type-def" id="ifFalse-method">ifFalse :: (Bool, Func) </h4>
      <p>The closure passed as parameter is performed if the value of this object is false.</p>
<pre><code class="php">$age = Int (18);                        # Object (Data\Int) { value: int (18) }
$age -> greaterOrEq (18)                # Object (Data\Bool) { value: bool (true) }
     -> ifTrue (function () {
          Str ("You're 18 years old or higher.")
            -> putStrLn ();
        });
     -> ifFalse (function () {
          Str ("Sorry, but you're so young.")
            -> putStrLn ();
        });
</code></pre><br />
      <!-- lesserOrEq method -->
      <h4 class="type-def" id="lesserOrEq-method">lesserOrEq :: (Eq a, Ord a) => (a, a) -> Bool</h4>
      <p>Returns if the value of this object is lesser or equal to the value of the received object. Deriving Ord, Eq.</p>
<pre><code class="php">Int (1) -> lesserOrEq (Int (10)); # Object (Data\Bool) { value: bool (true) }
Str ('Z') -> lesserOrEq (Str ('Z')); # Object (Data\Bool) { value: bool (true) }
</code></pre><br />
      <!-- lesserThan method -->
      <h4 class="type-def" id="greaterThan-method">greaterThan :: (Ord a) => (a, a) -> Bool</h4>
      <p>Returns if the value of this object is lesser than the value of the received object. Deriving Ord.</p>
<pre><code class="php">Int (1) -> lesserThan (Int (1)); # Object (Data\Bool) { value: bool (false) }
Float (10.0) -> lesserThan (8.34); # Object (Data\Bool) { value: bool (false) }
</code></pre><br />
      <!-- not method -->
      <h4 class="type-def" id="not-method">not :: Bool -> Bool</h4>
      <p>Negates the value of the object.</p>
<pre><code class="php">Bool (True) -> not (); # Object (Data\Bool) { value: bool (false) }
Bool (False) -> not (); # Object (Data\Bool) { value: bool (true) }
</code></pre><br />
      <!-- otherwise method -->
      <h4 class="type-def" id="otherwise-method">otherwise :: (Bool, Func) -> Bool</h4>
      <p>Alias to <a href="#ifFalse-method">ifFalse method</a>.</p>
<pre><code class="php">$age = Int (18);                        # Object (Data\Int) { value: int (18) }
$age -> greaterOrEq (18)                # Object (Data\Bool) { value: bool (true) }
     -> ifTrue (function () {
          Str ("You're 18 years old or higher.")
            -> putStrLn ();
        });
     -> otherwise (function () {
          Str ("Sorry, but you're so young.")
            -> putStrLn ();
        });
</code></pre><br />
      <!-- thenElse method -->
      <h4 class="type-def" id="thenElse-method">thenElse :: (Bool, Func, Func) -> Bool</h4>
      <p>The same as <code>-> ifTrue () -> iFalse ()</code>.</p>
<pre><code class="php">$age = Int (18)
  -> greaterOrEq (18)
  -> thenElse (
    function (/* then */) {
      Str ("You're 18 years old or higher.")
        -> putStrLn ();
    },
    function (/* else */) {
      Str ("Sorry, but you're so young.")
        -> putStrLn ();
    }
  );
</code></pre><br >
    </div>
    <div class="page-bottom col-lg-12" align="center">
      Rawr is open-source under MIT license and was developed with <span class="glyphicon glyphicon-heart"></span> by Marcelo Camargo
      (<a href="mailto:marcelocamargo@linuxmail.org">marcelocamargo at linuxmail period org</a>).
    </div>
    <!-- Highlight.js -->
    <link rel="stylesheet" href="../styles/obsidian.css">
    <script src="../highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
  </body>
</html>