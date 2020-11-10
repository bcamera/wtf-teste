<?php
	
	require_once('../../../../php/core/main.php');
	require_once('../../../../php/core/checkSession.php');

	$idSessao = $_SESSION['id'];
	$idNivel = $_SESSION['nivel'];
	$id = sanitize($link,'id');	

	// var_dump($_SESSION);

	$acao = 'Atender Agendamento';

	$querySelect = "SELECT * FROM agendamento WHERE id = $id";
	$ggQuery = mysqli_query($link,$querySelect);

	$selecionado = mysqli_fetch_object($ggQuery);

	$queryInsert = "INSERT INTO `auditoria`
								(`fk_usuario`,
								`acao`,
								`cpf`,
								`data_agendamento`,
								`hora_agendamento`)
								VALUES
								(
								$id,
								'$acao',
								'$selecionadocpf',
								'$selecionado->data_agendamento',
								'$selecionado->fk_hora_agendamento');";

	$auditoria = mysqli_query($link,$queryInsert);

	if ($auditoria){

		$queryUpdate = "UPDATE agendamento SET fk_status = 2 WHERE id = $id";

		$atualizado = mysqli_query($link,$queryUpdate);

		if( $atualizado ){
			
			header('Location: ../cadastrados/admin/sistema/home/index.php.php');
			exit();
			
		}else{
			echo  "<script>alert('Erro Interno!'); </script>";
			exit();
			
		}
	}
	else{
		echo  "<script>alert('Erro Interno!'); </script>";
		exit();	
	}

