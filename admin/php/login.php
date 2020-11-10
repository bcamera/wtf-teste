<?php

	error_reporting(-1);
	ini_set('display_errors', 'On');

	require_once('../../php/core/main.php');

	$login = mysqli_real_escape_string($link, strip_tags(trim($_POST['email'])));
	$senha = mysqli_real_escape_string($link, strip_tags(trim($_POST['senha'])));



	if(empty( $login ) || empty( $senha ))
	{
		header('Location: ../index.php?loginerror');
		die();
	}

	$ggquery = "SELECT * FROM usuario WHERE nome = '$login'";

    $query = mysqli_query($link, $ggquery);
    //echo $query;die;

	if( mysqli_num_rows( $query ) > 0)
	{
		$objeto = mysqli_fetch_object($query);

		$hash = $objeto->hash;
		$serversenha = $objeto->senha;
		$encsenha = hash('sha512', $senha . $hash);

		if( $serversenha == $encsenha )
		{
			$_SESSION['id'] = $objeto->id;
			$_SESSION['nome'] = utf8_encode($objeto->nome);
			$_SESSION['nivel'] = $objeto->fk_nivel;
//			header('Location: ../sistema/index.php');
//			die();
		
			if(($senha == '123456')||($objeto->primeiroacesso==1))
			{
					$_SESSION['tmp'] = 1;
					header('Location: ../sistema/usuarios/primeiro_acesso.php');
					die();
			}
			else
			{
				header('Location: ../sistema/home/index.php');
				die();
			}			
		}
		else
		{
			header('Location: ../index.php?loginerror');
		}
	}
	else
	{
		header('Location: ../index.php?loginerror');
	}
?>
