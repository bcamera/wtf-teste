<?php
	require_once('../../../php/core/main.php');
	require_once('../../../php/core/checkSession.php');
    
    if (isset($_POST['email'])){

		$nome = sanitize($link,'nome');
		$email = sanitize($link,'email');
		$senha = sanitize($link,'senha');
		$nivel = sanitize($link,'nivel');

		$hash = generateRandomString(128);
		$senha = hash('sha512',$senha.$hash);

		$sql = "INSERT INTO usuario
                (nome, email, senha, hash, primeiro_acesso, fk_nivel)
                VALUES
                ('$nome', '$email', '$senha', '$hash', 1, $nivel)";


		//var_dump($_POST);	echo $sql;	die();

		//redirect
		if ( mysqli_query($link , $sql) ){
			echo("<script type='text/javascript'> alert('Registrado com sucesso'); location.href='index.php';</script>");	
			die();
		}else{
			echo("<script type='text/javascript'> alert('Falha ao registrar'); location.href='index.php';</script>");	
			die();
		}	
		
	}
	
	$query = "SELECT * FROM nivel ORDER BY 2 ASC";
	$result = mysqli_query($link,$query);	
?>
<!DOCTYPE html>
<html>
	
	
	<?php require_once('../../layout/htmls/header2.php'); ?>
    <body class="bootstrap-admin-with-small-navbar">
		<?php require_once('../../layout/htmls/menu-superior-maior.php'); ?>
    	<?php require_once('../../../layout/htmls/banner-topo.php'); ?>	
        <div class="container">
            <div class="row">
				<div class="col-lg-12">
                    <h2>Cadastro de Usuários</h2><hr>						
					<form id="formulario" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-lg-6">					
                                <label>Nome</label>
                                <input class='form-control' type='text' name="nome" id="nome" maxlength='30' required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">				
                                <label>Login</label>
                                <input class='form-control' type='text' name="email" id="email" maxlength='60' required>
                            </div>				
                        </div>
                        <div class="form-group">			
                            <div class="col-lg-6">								
                                <label>Senha</label>
                                <input class='form-control' type="password" name="senha" id="senha" maxlength='30' required>
                            </div>
                            <div class="col-lg-6">							
                                <label>Confirmar Senha</label>
                                <input class='form-control  ' type="password" name="confirma_senha" id="confirma_senha"  maxlength='30' required>					
                            </div>						
                        </div>	
                        <div class="form-group">	
                            <div class="col-lg-6">
                            <label>Nível </label>
                                <select data-name="nivel" class="form-control" name="nivel" id="nivel" required>
                                    <option value="">Selecione...</option>
                                        <?php while (($nivel = mysqli_fetch_object($result)) != false):?>
                                            <option value="<?php echo $nivel->id?>"><?php echo ("$nivel->nivel") ?>
                                    </option> 
                                        <?php endwhile; ?>
                                </select> 	
                            </div>	
                        </div>
                        <div class="text-center" style="margin-bottom: 5rem;">				
                            <button type='submit' id='enviar' class='btn btn-large btn-success'><i class="glyphicon glyphicon-ok"></i> ENVIAR</button>&nbsp;
                            <button type='button' class='btn btn-large btn-danger' onclick='javascript:history.back();'><i class="glyphicon glyphicon-remove"></i>  VOLTAR</button>
                        </div>
					</form>
                </div>
            </div>
        </div>
		<?php require_once('../../layout/htmls/rodape.php'); ?>
        <?php require_once('../../layout/htmls/javascripts.php'); ?>
    </body>
</html>