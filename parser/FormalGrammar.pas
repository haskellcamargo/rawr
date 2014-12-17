{* Copyright (c) 2014 Marcelo Camargo <marcelocamargo@linuxmail.org>

   Permission is hereby granted, free of charge, to any person
   obtaining a copy of this software and associated documentation files
   (the "Software"), to deal in the Software without restriction,
   including without limitation the rights to use, copy, modify, merge,
   publish, distribute, sublicense, and/or sell copies of the Software,
   and to permit persons to whom the Software is furnished to do so,
   subject to the following conditions:

   The above copyright notice and this permission notice shall be
   included in all copies or substantial of portions the Software.

   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
   NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
   LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
   OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
   WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. *}
   
// EBNF definition for comment parsing and type constraint for Rawr
/** :: Str -> Num.Float */            => pass
/** :: (Int, Str) -> Bool */          => pass
/** :: (Eq a) => a -> Bool */         => pass
/** :: (Show a, Ord b) => a -> b */   => pass
/** :: Bool */                        => pass

type-definition := '::', [ '(' , typeclass-def, ')' | typeclass-def, '=>' ], 
                 ( rawr-type | user-type | min-letter ) | '(', not-unary, ')', 
                 { '->', rawr-type | user-type | min-letter } .
typeclass-def := typeclass, min-letter, { ',', typeclass-def } ;
rawr-type := 'Bool' | 'Collection' | 'Error' | 'File' | 'Func' | 'Null'
           | 'Num' | 'Num.Float' | 'Num.Int' | 'Object' | 'Str' | 'Undefined'
           | 'Void' .
user-type := { letter }, [ '.', user-type ] .
min-letter := 'a' | 'b' | 'c' | 'd' | 'e' | 'f' | 'g' | 'h' | 'i' | 'j' | 'k'
            | 'l' | 'm' | 'n' | 'o' | 'p' | 'q' | 'r' | 's' | 't' | 'u' | 'v'
            | 'w' | 'x' | 'y' | 'z' ;
not-unary := ( rawr-type | user-type | min-letter ), ',', { not-unary } .
typeclass = 'Eq' | 'Integral' | 'Ord' | 'Read' | 'Show' .
letter := min-letter | mai-letter .
mai-letter := 'A' | 'B' | 'C' | 'D' | 'E' | 'F' | 'G' | 'H' | 'I' | 'J' | 'K'
            | 'L' | 'M' | 'N' | 'O' | 'P' | 'Q' | 'R' | 'S' | 'T' | 'U' | 'V'
            | 'W' | 'X' | 'Y' | 'Z' .