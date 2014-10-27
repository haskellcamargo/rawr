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

	class Loop {
		private $from, $to, $by, $allow = [true, false, false, false], $length;

		# Specify from where the loop is starting.
		# Integer → Void
		public function from($i) {
			if ($this->allow[0]) $this->from = $i;
			$this->allow[1] = true;
			return $this;
		}

		# Specify until where the loop will pass.
		# Integer → Void
		public function until($i) {
			if ($this->allow[1]) $this->to = $i;
			$this->allow[2] = true;
			return $this;
		}

		# Specify to where the loop will pass.
		# Integer → Void
		public function to($i) {
			if ($this->allow[1])
				$this->to = $i;
				$this->to += (($this->from > $this->to) ? -1 : 1);

			$this->allow[2] = true;
			return $this;
		}

		# Specify the interval to loop.
		# Integer → Void
		public function by($i) {
			if ($this->allow[2]) $this->by = $i;
			$this->allow[3] = true;
			return $this;
		}

		# Specify what happens in the loop. You may want to pass 
		# the counter parameter in it.
		# Closure → Void
		public function should($clos) {
			$length = 0;
			if ($this->allow[3]) {
				if ($this->by < 0)
					for ($i = $this->from; $i > $this->to; $i = $i + $this->by) {
						$clos($i);
						$length++;
					}
				else 
					for ($i = $this->from; $i < $this->to; $i = $i + $this->by) {
						$clos($i);
						$length++;
					}
			}
			$this->allow = [false, false, false, false];
			$this->length = $length;
			return $this;
		}

		# Returns the length of the entries, as an object of Integer.
		# Void → Integer
		public function num_entries() {
			return new Integer($this->length);
		}
	}