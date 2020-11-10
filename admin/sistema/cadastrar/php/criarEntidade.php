<?php
	
	require_once('../../../../php/core/main.php');
	require_once('../../../../php/core/checkSession.php');

	$id = sanitize($link,'id');	
	$descricao = sanitize($link,'descricao');	

	// var_dump($_SESSION);
			
			$insert="INSERT INTO tipo (descricao)	VALUES ('$descricao');"; 

				//echo  "<script>console.log($insert);</script>";
				//echo $insert;
				$inserido = mysqli_query($link,$insert);
				$idcurso = mysqli_insert_id($link);
		 
			
				if( $inserido ){

					$idcurso = mysqli_insert_id($link);
					
					if($prefeituras){
						$erro=0;
						$mensagem="";

						if( !$erro ){
							header('Location: ../cadastrar_entidades.php?sucesso');
							exit();
						}
					}else{
						header('Location: ../cadastrar_entidades.php?sucesso');
						exit();
					}
					
				}else{
					echo  "<script>alert('Erro Ao Cadastrar!'); </script>";
					exit();
					
				}
			


?>