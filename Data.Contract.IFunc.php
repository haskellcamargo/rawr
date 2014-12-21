<?php
  # Copyright (c) 2014 Haskell Camargo <haskell@linuxmail.org>
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

  namespace Data\Contract;

  interface IFunc {
    public function __construct($func);             # :: a -> a
    public function ⃝($func);                       # (Func, Func) -> Func
    public function closScopeClass();               # :: Func -> ReflectionClass
    public function closThis();                     # :: Func -> Object
    public function docComment();                   # :: Func -> String
    public function endLine();                      # :: Func -> Int
    public function export($ret = false);           # :: (Func, Maybe Bool) -> String
    public function ext();                          # :: Func -> ReflectionExtension
    public function ext_name();                     # :: Func -> String
    public function file_name();                    # :: Func -> String
    public function get_clos();                     # :: Func -> Closure
    public function in_ns();                        # :: Func -> Bool
    public function invoke();                       # :: Maybe Dynamic -> Maybe Dynamic
    public function is_clos();                      # :: Func -> Bool
    public function is_depr();                      # :: Func -> Bool
    public function is_disabled();                  # :: Func -> Bool
    public function is_gen();                       # :: Func -> Bool
    public function is_internal();                  # :: Func -> Bool
    public function is_user_def();                  # :: Func -> Bool
    public function is_variadic();                  # :: Func -> Bool
    public function name();                         # :: Func -> String
    public function ns_name();                      # :: Func -> String
    public function num_param();                    # :: Func -> Int
    public function num_req_param();                # :: Func -> Int
    public function param();                        # :: Func -> [ReflectionParameter]
    public function o($func);                       # :: (Func, Func) -> Func
    public function retRef();                       # :: Func -> Bool
    public function shortName();                    # :: Func -> String
    public function startLine();                    # :: Func -> Int
    public function staticVar();                    # :: Func -> Collection
  }