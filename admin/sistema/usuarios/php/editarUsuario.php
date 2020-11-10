<?php
require_once('../../../../php/core/main.php');
require_once('../../../../php/core/checkSession.php');


$nome = sanitize($link,'nome');
$email = sanitize($link,'email');
$senha = sanitize($link,'senha');
$nivel = sanitize($link,'nivel');
$id = sanitize($link,'idUsuario');

$hash = generateRandomString(128);
$senha = hash('sha512',$senha.$hash);

$sql = "UPDATE usuario
set nome = '$nome', email = '$email', senha = '$senha', hash = '$hash', fk_nivel = $nivel 
where id = $id";


//var_dump($_POST);	echo $sql;	die();

		//redirect
if ( mysqli_query($link , $sql) ){
	echo("<script type='text/javascript'> alert('Atualizado com sucesso'); location.href='../index.php';</script>");	
	die();
}else{
	echo("<script type='text/javascript'> alert('Falha ao atualizar'); location.href='../index.php';</script>");	
	die();
}	

?>