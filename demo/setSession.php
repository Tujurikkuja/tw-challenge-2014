<?php
	session_start();
	if($_POST){
		$_SESSION = array_merge($_SESSION, $_POST);
		var_dump($_POST);
	}	
?>