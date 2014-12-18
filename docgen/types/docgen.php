<?php
  $doc = simplexml_load_file("doc.xml");

  function methodList() {
    global $doc;
    foreach ($doc->list->method as $method)
      echo "\t\t<li><a href=\"#{$method}-method\">{$method}</a></li>\n";
  }

  function typeclassList() {
    global $doc;
    foreach ($doc->typeclasses->typeclass as $typeclass)
      echo "\t\t<li><a href=\"../TypeClass.{$typeclass}.html\">{$typeclass}</a></li>\n";
  }

  function interfaceList() {
    global $doc;
    foreach ($doc->interfaces->interface as $interface)
      echo "\t\t<li><a href=\"{$interface->link}\">{$interface->name}</a></li>\n";
  }
?>
<!DOCTYPE html>
<html charset="utf-8">
  <head>
    <title>Rawr Docs - <?=$doc->title?></title>
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
            <li><a href="<?=$doc->parent->link?>"><?=$doc->parent->name?></a></li>
          </ul>
        </div>
        <div class="block">
          <div class="block-title"><h4>Interfaces</h4></div>
          <ul>
<?php interfaceList(); ?>
          </ul>
        </div>
        <div class="block">
          <div class="block-title"><h4>Typeclasses</h4></div>
          <ul>
<?php typeclassList(); ?>
          </ul>
        </div>
        <div class="block">
          <div class="block-title"><h4>Methods</h4></div>
          <ul>
<?php methodList(); ?>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 readable-content">
        <h2><?=$doc->title?> Class</h2>
        <h3>Description</h3>
        <p><?=$doc->description?></p>
        <p>In <code><?=$doc->namespace?></code> namespace.</p>
        <h3>Aliases</h3>
<pre><code class="php"><?=$doc->aliases?></code></pre>
      <h3>Methods</h3><br />
      <!-- _and method -->
<?php
  foreach ($doc->methods->method as $method) {
?>
      <h4 class="type-def" id="<?=$method->name?>-method"><?=$method->signature?></h4>
      <p><?=$method->description?></p>
<pre><code class="php"><?=$method->code?></code></pre><br />
<?php
  }
?>
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