<?php
	function redirect($url) {
	    ob_start();
		$url = strtolower($url);
	    if($url == "index"){
	    	header('Location: ' . 'pages/' . $url . '/' . $url . '.php');
	    } else {
			header('Location: ' . '../' . $url . '/' . $url . '.php');	    	
	    }
	    ob_end_flush();
	    die();
	}
?>