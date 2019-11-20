<?php

	/**
	 * MyCripty - classe para criptografar e reverter a criptografia de forma facil, simples e segura utilizando PHP.
	 *
	 * @author Hudolf Jorge Hess
	 * @version 2.0b
	 * @link www.hudolfhess.com
	 */
	class MyCripty {

		/**
		 * @var int
		 */
		public $chave = 97;

		/**
		 * @var string
		 */
		public $add_text = "NTM1ZmEzMGQ3ZTI1ZGQ4YTQ5ZjE1MzY3Nzk3MzRlYzgyODYxMDhkMTE1ZGE1MDQ1ZDc3ZjNiNDE4NWQ4Zjc5MDExNThlN2UxMmM1ZTczNjIzMThlNWUzYzJlMWYyZjFhYjQ5NTc4YWIxZDE2OTFlOTgxOGE3YzNmNmIzMGI1Mjg";

		/**
		 * @param string Palavra
		 * @return string
		 */
		function enc($pword) {
			$word = $pword . $this->add_text;
			$s = strlen($word) + 1;
			$nw = "";
			$n = $this->chave;
			if (($s * $n) > PHP_INT_MAX) {
				$nw = $this->encLarg($pword);
				return $nw;
			}

			for ($x = 1; $x < $s; $x++) {
				$m = $x * $n;
				if ($m > $s) {
					$nindex = $m % $s;
				} else if ($m < $s) {
					$nindex = $m;
				}
				if ($m % $s == 0) {
					$nindex = $x;
				}
				$nw = $nw . $word[$nindex - 1];
			}
			return $nw;
		}

		/**
		 * @param string Palavra
		 * @return string
		 */
		function dec($word) {
			$s = strlen($word) + 1;
			$nw = "";
			$n = $this->chave;
			if (($s * $n) > PHP_INT_MAX) {
				$nw = $this->decLarg($word);
				return $nw;
			}
			for ($y = 1; $y < $s; $y++) {
				$m = $y * $n;
				if ($m % $s == 1) {
					$n = $y;
					break;
				}
			}
			for ($x = 1; $x < $s; $x++) {
				$m = $x * $n;
				if ($m > $s) {
					$nindex = $m % $s;
				} else if ($m < $s) {
					$nindex = $m;
				}
				if ($m % $s == 0) {
					$nindex = $x;
				}
				$nw = $nw . $word[$nindex - 1];
			}
			$t = strlen($nw) - strlen($this->add_text);
			return substr($nw, 0, $t);
		}

		/* correcao cripto strlen> 26537 (32bis) 113977139216969(64bis) */

		
		function decLarg($word) {
			$s = strlen($word) + 1;
			$nw = "";
			$n = $this->chave;
			for ($y = 1; $y < $s; $y++) {
				$m = $y * $n;
					$k = floor($m / $s);
					$r = $m - ($k * $s);
					if ($r == 1) {
						$n = $y;
						break;
					}
				}
			for ($x = 1; $x < $s; $x++) {
				$m = $x * $n;
				if ($m > $s) {
						$k = floor($m / $s);
						$nindex = $m - ($k * $s);
				} else if ($m < $s) {
					$nindex = $m;
				} else {
					$k = floor($m / $s);
					$w = $m - ($k * $s);
					if ($w == 0) {
						$nindex = $x;
					}
				}
				$nw = $nw . $word[$nindex - 1];
			}
			$t = strlen($nw) - strlen($this->add_text);
			return substr($nw, 0, $t);
		}

		function encLarg($word) {
			$word .= $this->add_text;
			$s = strlen($word) + 1;
			$nw = "";
			$n = $this->chave;
			for ($x = 1; $x < $s; $x++) {
				$m = $x * $n;
				if ($m > $s) {
					if ($m < PHP_INT_MAX) {
						$nindex = $m % $s;
					} else {
						$k = floor($m / $s);
						$nindex = $m - ($k * $s);
					}
				} else if ($m < $s) {
					$nindex = $m;
				} else {
					$k = floor($m / $s);
					$w = $m - ($k * $s);
					if ($w == 0) {
						$nindex = $x;
					}
				}
				$nw = $nw . $word[$nindex - 1];
			}
			return $nw;
		}

	}
	