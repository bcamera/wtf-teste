<?php

	function logado( $campo )
	{
		if( ! isset( $_SESSION ) || empty( $_SESSION ) || ! isset( $_SESSION[$campo] ) )
			return false;
		else
			return true;
	}
	
	function auth($id, $location)
	{
		if( ! logado( $id ) )
		{
			header('Location ' . $location . '2312');
		}
	}