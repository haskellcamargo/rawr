module Library 
( each ) where

-- Apply a function for each element of a list with side-effects.
each :: (Monad m) => (b -> m a) -> [b] -> m a
each fun (x:[]) = fun x
each fun (x:xs) = do
  fun x
  each fun xs