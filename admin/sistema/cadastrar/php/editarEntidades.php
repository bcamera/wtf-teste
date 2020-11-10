<?php
	
	require_once('../../../../php/core/main.php');
	require_once('../../../../php/core/checkSession.php');

	$idSessao = $_SESSION['id'];
	$idNivel = $_SESSION['nivel'];
	$id = sanitize($link,'id');	 
	$descricao = sanitize($link, 'descricao');
	$nome = sanitize($link, 'nome');

	// var_dump($_SESSION);
		if(!empty($id))
		{	
			$update = "UPDATE tipo SET descricao = '$descricao' WHERE id = $id";
			//echo $update;
			//die();
			$sucesso = mysqli_query($link,$update);
			if($sucesso){
				$erro=0;
				$mensagem="";

				if( !$erro ){
					header('Location: ../tipos.php?editarsucesso');
					exit();
				}else{
					echo  "<script>alert('Erro, dados não gravados! ".$mensagem."'); history.back();</script>";
					exit();

				}


			}else{
				header('Location: ../tipos.php?editarsucesso');
				exit();
			}




		}else{
			echo  "<script>alert('Parametro Invalido!'); history.back();</script>";
			exit();
			
		}

?>