<?php
	class Boolean extends DataTypes {
		public function __construct($val) {
			$this->value = (boolean) $val;
			return $this;
		}

		public function if_true($clos) {
			if ($this->value) $clos();
			return $this;
		}

		public function if_false($clos) {
			if (!$this->value) $clos();
			return $this;
		}

		public function then_else($then, $else) {
			if ($this->value) $clos();
			else $else();
		}

		public function repeat($clos) {
			while ($this->value) {
				$clos();
			}
		}
	}
		