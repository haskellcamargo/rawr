<?php
  # Copyright (c) 2014 Marcelo Camargo <marcelocamargo@linuxmail.org>
  #
  # Permission is hereby granted, free of charge, to any person
  # obtaining a copy of this software and associated documentation files
  # (the "Software"), to deal in the Software without restriction,
  # including without limitation the rights to use, copy, modify, merge,
  # publish, distribute, sublicense, and/or sell copies of the Software,
  # and to permit persons to whom the Software is furnished to do so,
  # subject to the following conditions:
  #
  # The above copyright notice and this permission notice shall be
  # included in all copies or substantial of portions the Software.
  #
  # THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  # EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  # MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  # NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
  # LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
  # OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
  # WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

  define("MT_RAND_MAX", mt_getrandmax());
  define("RAND_MAX", getrandmax());
  define("RAWR_VERSION", "1.0.0.2");

  # New Keywords
  # true and false must be instances of TrueClass and FalseClass
  define("No",        false);
  define("Off",       false);
  define("On",        true);
  define("Yes",       true);
  define("otherwise", "[:otherwise:]");

  /* Take care with the purism. Hitler started this way (Linspector, Torrens). */
  define("Maybe",     mt_rand() /* Change this */);

  # Type-safety for objects and default values for empty objects.

  /************** ALIAS ********** FOR TYPE ***********/
  /**/ define("Bool",        "Data\\Bool");         /**/
  /**/ define("Boolean",     "Data\\Bool");         /**/
  /**/ define("Collection",  "Data\\Collection");   /**/
  /**/ define("Error",       "Data\\Error");        /**/
  /**/ define("File",        "Data\\File");         /**/
  /**/ define("Func",        "Data\\Func");         /**/
  /**/ define("Float",       "Data\\Num\\Float");   /**/
  /**/ define("Int",         "Data\\Num\\Int");     /**/
  /**/ define("Null",        "Data\\Null");         /**/
  /**/ define("Num",         "Data\\Num");          /**/
  /**/ define("Str",         "Data\\Str");          /**/
  /**/ define("String",      "Data\\Str");          /**/
  /**/ define("Undefined",   "Data\\Undefined");    /**/
  /**/ define("Void",        "Data\\Void");         /**/
  /****************************************************/