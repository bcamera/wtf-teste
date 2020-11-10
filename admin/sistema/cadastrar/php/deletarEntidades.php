<?php
	
	require_once('../../../../php/core/main.php');
	require_once('../../../../php/core/checkSession.php');

	$idSessao = $_SESSION['id'];
	$idNivel = $_SESSION['nivel'];
	$id = sanitize($link,'id');	

	// var_dump($_SESSION);

	$queryCheca = "SELECT * FROM atendimento where fk_tipo = $id";

	$vagas = mysqli_query($link,$queryCheca);

	$total = mysqli_num_rows($vagas);

	if ($total < 1){

			$queryDelete = "DELETE FROM tipo WHERE id = $id";

			$deletado = mysqli_query($link,$queryDelete);

			if( $deletado ){
				
				header('Location: ../tipos.php?deletsucesso');
				exit();
				
			}else{
				echo  "<script>alert('Erro Interno!'); </script>";
				exit();
				
			}
		}else{
				echo  "<script>alert('Existe atendimento associado ao tipo!'); </script>";
				exit();
				
		}
	}else{				
		header('Location: ../tipos.php?deleterror');
		exit();
	}
