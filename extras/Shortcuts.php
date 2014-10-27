<?php

	function boolean($v) {
		return new Boolean($v);
	}

	function integer($v) {
		return new Integer($v);
	}

	function loop() {
		return new Loop; 
	}

	function string($v) {
		return new String($v);
	}