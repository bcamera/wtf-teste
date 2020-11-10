<?php
	require_once('../../../php/core/main.php');
	require_once('../../../php/core/checkSession.php');
	
	if( ! logado('id') or ($_SESSION['nivel'] == 3) )
	{
		header('Location: ../../index.php?loginerror');
	}

	$id = sanitize($link, 'id');
	
	$queryDesbloquear = "UPDATE usuario set ativo = 0 WHERE id = $id";

	$desbloqueio = mysqli_query($link, $queryDesbloquear);

	if ( $desbloqueio ){
		echo("<script type='text/javascript'>  location.href='index.php?sucesso';</script>");	
		 header("Location: index.php");
	}
	else{
		echo("<script type='text/javascript'> alert('Falha ao desativar'); location.href='index.php?erro';</script>");	
		die();
	}
	
?>