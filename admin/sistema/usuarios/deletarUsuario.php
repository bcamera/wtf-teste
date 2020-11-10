<?php
	require_once('../../../php/core/main.php');
	require_once('../../../php/core/checkSession.php');
	
	if( ! logado('id') or ($_SESSION['nivel'] != 1) )
	{
		header('Location: ../../index.php?loginerror');
	}

	$idUsuarioDeletar = sanitize($link, 'id');

	$existeAtendimento = mysqli_query($link, "SELECT * FROM atendimento where fk_usuario = $idUsuarioDeletar";

	if mysqli_num_rows($existeAtendimento) > 0){
				echo("<script type='text/javascript'> alert('Existe atendmento associado ao técnico'); location.href='index.php?erro';</script>");
				die();
	}

	
	$query="DELETE FROM usuario WHERE id = '$idUsuarioDeletar'";

	//echo $query;exit;

	$result = mysqli_query($link, $query);
	if ( $result ){
		echo("<script type='text/javascript'>  location.href='index.php?sucesso';</script>");	
		 header("Location: index.php");
	}
	else{
		echo("<script type='text/javascript'> alert('Falha ao excluir'); location.href='index.php?erro';</script>");	
		die();
	}
	
?>