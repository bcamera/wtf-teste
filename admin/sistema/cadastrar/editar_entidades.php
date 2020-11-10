<?php
require_once('../../../php/core/main.php');
require_once('../../../php/core/checkSession.php');

$id = sanitize($link,'id');

$query = mysqli_query($link,"SELECT * FROM tipo WHERE id = '$id' ");
if( mysqli_num_rows($query) == 0 ) die(
	"<script type='text/javascript'> alert('Tipo Inválido!');window.history.back();</script>");
	
	$dados = mysqli_fetch_object($query);

	?>
	<!DOCTYPE html>
	<html>
	
	<?php require_once('../../layout/htmls/header2.php'); ?>

	<body class="bootstrap-admin-with-small-navbar">
		<!--  Script mostra input de pendencia -->
		<?php require_once('../../layout/htmls/menu-superior-maior.php'); ?>
	<div class="container">
		<div class="d-flex flex-row">

			<!-- content -->
			<div class="col-md-12">
				
				<div class="d-flex flex-row">
					<div class="col-12 d-flex justify-content-center">
					<div class="page-header mt-2">
						<h3 class="blue">Edição dos Tipos de Atendimentos</h3>
						</div>
					</div>
				</div>
			</div>
		</div>

				<div class="d-flex flex-row">
					<div class="col-12 d-flex justify-content-center">

						<?php if( isset($_GET['sucesso']) ) : ?>
							<div  class="form-group" style="margin: 5px 0px;">
								<div class="alert alert-success" role="alert">
									<b>Alterado com sucesso.</b>
								</div>
							</div>
						<?php endif; ?>
						<div class="controls">
							<br />
							<p id="pb_editar_mensagem_erro" class="error alert alert-danger" style="display: none;"></p>
						</div>
						<?php if( isset( $_GET['erro'] ) ) : ?>
							<div class="form-group">
								<div id="tentativaLogin" class="alert alert-danger" role="alert">
									<b>O status não foi definido. Por favor, tente novamente.</b>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="d-flex flex-row">
					<div class="col-12">

						<form id="pb_editar_formulario" class="form-horizontal" action="php/editarEntidades.php" method="post">

							<fieldset>
								<div class="d-flex flex-row">
									<div class="offset-sm-4 col-sm-4">
										<input id="id" name="id" type="hidden" value="<?php echo $id; ?>" />
										<h5 class="blue">Descrição</h5>
										<input id="descricao" name="descricao" type="text" value="<?php echo $dados->descricao;?>" class="span12 m-wrap form-control">
										<button type="button" id="pb_editar_botao" class="btn btn-primary mt-2">Gravar</button>
										<button type='button' class='btn btn-large btn-danger mt-2' onclick='javascript:history.back();'><i class="glyphicon glyphicon-remove"></i> VOLTAR</button>                    
									</div>                                              	                                              	
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				<br>

			</div> <!-- Fim do painel-->

		<?php require_once('../../layout/htmls/javascripts.php'); ?>
		<?php require_once('../../layout/htmls/rodape.php'); ?>
	</body>

	</html>



	<!-- JQUERY UI -->
	<?php require_once('js/editar_entidades.js'); ?>

