<?php
	$bool = new Boolean(true);
	$bool = & boolean(true);

	$expects = function(Boolean $xs) {
		if ($xs) {
			# Do
		} else {
			# Do
		}
	}

	$add = $bool->ifTrue(& func(function() {
		return & func(function($x, $y) {
			return $x + $y;
		});
	})->call()); # Higher order functions

	$bool->ifTrue(function() {

	});