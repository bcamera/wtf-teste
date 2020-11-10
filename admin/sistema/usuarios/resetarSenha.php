<?php
    require_once('../../../php/core/main.php');
    require_once('../../../php/core/checkSession.php');

	// if( ! logado('id') or (($_SESSION['nivel'] != 1) AND ($_SESSION['nivel'] != 2)) ) {
	// 	header('Location: ../../index.php?loginerror');
	// 	die();
    // }
    
    //var_dump($_GET);

	$idUsuario = sanitize3($link, $_GET['id']);
	
	$senha = '123456';
	$chave = generateRandomString( 128 );
	$encriptada = hash( 'sha512', $senha . $chave );

	$query = "
	UPDATE
		usuario
	SET
		senha = '".$encriptada."',
		hash = '".$chave."'
	WHERE id = ".$idUsuario." ";
	//exit($query);

	if ( mysqli_query( $link, $query ) ) {
		$query = str_ireplace("'", '"', $query);
		// echo($query); exit();

		$audit = "
		INSERT INTO `auditoria`
		(
			`acao`,
			`fk_usuario`
		)
		VALUES
		(
			'reset senha ID=$idUsuario',
			".$_SESSION['id']."
		) ";
		// exit($audit);

		$saida = mysqli_query($link, $audit);

		if( ! $saida ) {
			echo "<script>alert('Falha na auditoria.');location.href='index.php'</script>";	
		}

		echo "<script>alert('Senha alterada.');location.href='index.php'</script>";
		die();
	}
	else {
			echo "<script>alert('Falha no reset');location.href='index.php'</script>";
	}

?>