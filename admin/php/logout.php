<?php
	require_once('../../php/core/main.php');
	session_start();
	session_destroy();
	unset($_SESSION);
	header('Location: ../index.php');
?>