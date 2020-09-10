<?php
	function redirect($url) {
	    ob_start();
		$url = strtolower($url);
		header('Location: ' .  $url . '.php');
	    ob_end_flush();
	    die();
	}
?>