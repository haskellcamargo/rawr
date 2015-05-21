-- TODO SOON:
  - Refactorate the lexer, in ./patternMatching/.
  - Comment the lexer source.
  - Write the parser to generate the AST.
  - Create an interface for calling the lexer + parser and returning the ast.
  - Create a PHP-object to pattern-matching AST translator.


progress: {
  todo: {
    types: [
      "Data.Collection"
    , "Data.Error"
    , "Data.File"
    , "Data.Func"
    , "Data.Match"
    , "Data.Object"
    , "Data.Str"
    , "Data.Type"
    ]
  }
, ready: {
    types: [
      "Data.Bool"
    , "Data.Either"
    , "Data.Either.Left"
    , "Data.Either.Right"
    , "Data.Maybe"
    , "Data.Maybe.Just"
    , "Data.Maybe.Nothing"
    , "Data.Num"
    , "Data.Num.Float"
    , "Data.Num.Int"
    , "Data.Tuple"
    ]
  , contracts: []
  }
, documented: {
    types: [
      "Data.Bool"
    , "Data.Either"
    , "Data.Maybe"
    , "Data.Tuple"
    ]
  , contracts: []
  }
}
