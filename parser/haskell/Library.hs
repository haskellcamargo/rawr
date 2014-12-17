module Library 
( each ) where

each :: (Monad m) => (b -> m a) -> [b] -> m a
each fun (x:[]) = fun x
each fun (x:xs) = do
  fun x
  each fun xs