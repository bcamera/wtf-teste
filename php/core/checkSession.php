<?php
	
	if( ! logado('id') )
	{
		header('Location: ../../index.php?loginerror4');
	}

	//var_dump($_SESSION);die;

	if(isset($_SESSION['tmp']) && $_SESSION['tmp']== 1) {
		session_start();
		session_destroy();
		unset($_SESSION);
		header('Location: ../../index.php');
	}

	$FK_idUsuario = $_SESSION['id'];

	// if($_SESSION['id'] != 12) {
	// 	session_destroy();
	// 	unset($_SESSION);
	// 	// header('Location: ../index.php');
	// 	die();
	// }


		
	$actual_link = $_SERVER['PHP_SELF'];

	if($actual_link != "/admin/sistema/cadastrados/visualizarCadastrado.php" && $actual_link != "/admin/sistema/cadastrados/avaliar_cadastrado.php" && $actual_link != "/admin/sistema/cadastrados/editarCadastrado.php") {
		$query ="UPDATE usuarios set candidato_em_avaliacao = NULL WHERE id = " . $_SESSION['id'];
		$ggQuery = mysqli_query($link,$query);
	}

//    $id = sanitize($link,'id');

//    if($actual_link != "/admin/sistema/cadastrados/visualizarCadastrado.php") {
// 		$query ="UPDATE cadastrados set avaliador = NULL WHERE id = " . $id;
// 		$ggQuery = mysqli_query($link,$query);
//    }



?>