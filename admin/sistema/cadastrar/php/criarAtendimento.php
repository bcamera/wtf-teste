<?php
	
	require_once('../../../../php/core/main.php');
	require_once('../../../../php/core/checkSession.php');

	$id = sanitize($link,'id');	
	$observacao = sanitize($link,'observacao');	
	$tipo = sanitize($link,'tipo');	
	$nome_cliente = sanitize($link,'nome_cliente');	

	// var_dump($_SESSION);
			
			$insert="INSERT INTO atendimento (observacao, nome_cliente, fk_tipo, fk_usuario)	VALUES ('$observacao', '$nome_cliente', $tipo, $id);"; 

				//echo  "<script>console.log($insert);</script>";
				echo $insert;
				$inserido = mysqli_query($link,$insert);
				$idcurso = mysqli_insert_id($link);
		 
			
				if( $inserido ){

					$idcurso = mysqli_insert_id($link);
					
					if($prefeituras){
						$erro=0;
						$mensagem="";

						if( !$erro ){
							header('Location: ../atendimento.php?sucesso');
							exit();
						}
					}else{
						header('Location: ../atendimento.php?sucesso');
						exit();
					}
					
				}else{
					echo  "<script>alert('Erro Ao Cadastrar!'); </script>";
					exit();
					
				}
			


?>