<?php
require_once('../../../php/core/main.php');
require_once('../../../php/core/checkSession.php');
if( ! logado('id') or ($_SESSION['nivel'] == 3) )
{
	header('Location: ../../index.php?loginerror');
}

$idUsuarioEditar = $_GET['id'];

$query = mysqli_query($link, "SELECT * FROM usuario WHERE usuario.id = '$idUsuarioEditar' ");

if( mysqli_num_rows($query) == 0 ) die('Usuario desconhecido.');

$dadosUsuarioCadastrado = mysqli_fetch_object($query);


$queryNivel = mysqli_query($link, "SELECT * FROM nivel");

?>
<!DOCTYPE html>
<html>

<?php require_once('../../layout/htmls/header2.php'); ?>

<body class="bootstrap-admin-with-small-navbar">
	<!--  Script mostra input de pendencia -->

	<?php require_once('../../layout/htmls/menu-superior-maior.php'); ?>

	<div class="container">

		<div class="row">
			<!-- content -->
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="page-header">
							<h1>Edição de Usuário</h1>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default bootstrap-admin-no-table-panel">
							<div class="panel-heading">
								<div class="text-muted bootstrap-admin-box-title">Dados do Usuário</div>
							</div>
							<div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content">
								<?php if( isset($_GET['sucesso']) ) : ?>
									<div  class="form-group" style="margin: 5px 0px;">
										<div class="alert alert-success" role="alert">
											<b>Alterado com sucesso.</b>
										</div>
									</div>
								<?php endif; ?>
								<div class="controls">
									<br />
									<p id="usuarios_editar_mensagem_erro" class="error alert alert-danger" style="display: none;"></p>
								</div>
								<?php if( isset( $_GET['erro'] ) ) : ?>
									<div class="form-group">
										<div id="tentativaLogin" class="alert alert-danger" role="alert">
											<b>O status não foi definido. Por favor, tente novamente.</b>
										</div>
									</div>
								<?php endif; ?>

								<form id="usuarios_editar_formulario" class="form-horizontal" action="php/editarUsuario.php" method="post">
									<input id="idUsuario" name="idUsuario" type="hidden" value="<?php echo $dadosUsuarioCadastrado->id; ?>" />
									<fieldset>
										<div class="form-group">
											<label class="col-lg-2 control-label" for="focusedInput">Nome</label>
											<div class="col-lg-10">
												<input id="nome" name="nome" type="text" value="<?php echo $dadosUsuarioCadastrado->nome; ?>" class="span12 m-wrap form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label" for="focusedInput">login</label>
											<div class="col-lg-10">
												<input id="email" name="email" type="text" value="<?php echo $dadosUsuarioCadastrado->email; ?>"  class="span12 m-wrap form-control"/>
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
													<?php while (($nivel = mysqli_fetch_object($queryNivel)) != false):?>
														<option value="<?php echo $nivel->id;?>"><?php echo ("$nivel->nivel") ?>
													</option> 
												<?php endwhile; ?>
											</select> 	
										</div>	
									</div>											

									<input type="submit" name="usuarios_editar_botao_criar" value="Gravar alterações" class="btn btn-primary">	
									<a href="index.php" class="btn btn-warning" >Voltar</a>											
									<!-- button type="button" id="usuarios_editar_botao_criar" class="btn btn-primary">Gravar alterações</button> -->

								</fieldset>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<?php require_once('../../layout/htmls/rodape.php'); ?>
<?php require_once('../../layout/htmls/javascripts.php'); ?>
</body>

</html>


<!-- JQUERY UI -->
<script src="js/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">

