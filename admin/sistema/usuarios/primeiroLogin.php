<?php

	require_once('../../../php/core/main.php');
	$idUsuario = $_SESSION['id'];
	$Niveis_idNivel = $_SESSION['nivel'];

	if( !empty( $_POST['senha1'] ) && ! empty( $_POST['senha2'] ) )
	{
		$senha = $_POST['senha2'];
		$chave = generateRandomString( 128 );
		$ecnsenha = hash('sha512', $senha. $chave);
		$query = "UPDATE usuario SET senha = '$ecnsenha', hash = '$chave', primeiro_acesso=0 WHERE id = $idUsuario";
	 
	 	echo $query;
		if ( mysqli_query( $link, $query ) )
		{
			$_SESSION['tmp']=0;
			header('Location: ../../index.php?sucesso=1');
			exit();
		}else{
			echo "Erro";
		}
	}
	

	 
?>