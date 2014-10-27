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

	# Use memoization to store already processed data in a static variable
	# This way you can increase the performance in more than 95% of 
	# already processed data.

	require_once 'Binary.class.php';
	require_once 'Boolean.class.php';
	require_once 'Byte.class.php';
	require_once 'Char.class.php';
	require_once 'Double.class.php';
	require_once 'Either.class.php';
	require_once 'Float.class.php';
	require_once 'Func.class.php';
	require_once 'Integer.class.php';
	require_once 'Loop.class.php';
	require_once 'Object.class.php';
	require_once 'String.class.php';
	require_once 'Extras/Shortcuts.php';
	require_once 'Modules/Memoize.class.php';

	# Types may want to inherit from this class.
	class Datatypes {
		protected $value, $memoize;

		public function __construct() {
			global $memoize;
			$this->memoize = $memoize;
			return $this;
		}

		# Returns the element by itself.
		# Mixed → Mixed
		public function id() {
			return $this;
		}

		# Equivalent to php's var_dump.
		# Mixed → Void
		public function inspect() {
			var_dump($this->value);
			return $this;
		}

		# Returns the protected value as a php primitive.
		# Mixed → Mixed
		public function value() {
			return $this->value;
		}

		# Casts to Binary.
		# Mixed → Binary
		public function to_binary() {
			return new Binary($this->value);
		}

		# Casts to Boolean.
		# Mixed → Boolean
		public function to_boolean() {
			return new Boolean($this->value);
		}

		# Casts to Byte.
		# Mixed → Byte
		public function to_byte() {
			return new Byte($this->value);
		}

		# Casts to Char.
		# Mixed → Char
		public function to_char() {
			return new Char($this->value);
		}

		# Casts to Double.
		# Mixed → Double
		public function to_double() {
			return new Double($this->value);
		}

		# Casts to Either.
		# Mixed → Either
		public function to_either() {
			return new Either($this->value);
		}

		# Casts to Float.
		# Mixed → Float
		public function to_float() {
			return new Float($this->value);
		}

		# Casts to Func.
		# Mixed → Func
		public function to_func() {
			return new Func($this->value);
		}

		# Casts to Integer.
		# Mixed → Integer
		public function to_i() {
			return new Integer($this->value);
		}

		# Casts to Loop (Why in the world would somebody do this!?).
		# Mixed → Loop
		public function to_loop() {
			return new Loop($this->value);
		}

		# Casts to Object.
		# Mixed → Object
		public function to_object() {
			return new Object($this->value);
		}

		# Casts to String.
		# Mixed → String
		public function to_s() {
			return new String($this->value);
		}
	}