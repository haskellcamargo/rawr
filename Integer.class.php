<?php
	class Integer extends DataTypes {

		public function __construct($i) {
			$this->value = (int) $i;
		}

		public function abs() {
			$this->value = abs($this->value);
			return $this;
		}

		public function add($value) {
			$this->value += $value;
			return $this;
		}

		public function div($value) {
			$this->value /= $value;
			return $this;
		}

		public function mod($value) {
			$this->value %= $value;
			return $this;
		}

		public function mul($value) {
			$this->value *= $value;
			return $this;
		}

		public function pow($to) {
			$this->value = pow($this->value, $to);
			return $this;
		}

		public function sub($value) {
			$this->value -= $value;
			return $this;
		}

		public function sqrt() {
			$this->value = new Float(sqrt($this->value));
			return $this;
		}		
	}
?>