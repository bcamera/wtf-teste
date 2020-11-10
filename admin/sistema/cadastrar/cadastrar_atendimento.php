<?php
require_once('../../../php/core/main.php');
require_once('../../../php/core/checkSession.php');

$query = "SELECT * FROM tipo ORDER BY 2 ASC";
$result = mysqli_query($link,$query);	

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
							<h3 class="blue">Cadastro dos Atendimentos</h3>
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
							<b>Cadastrado com sucesso.</b>
						</div>
					</div>
				<?php endif; ?>
				<div class="controls">
					<br />
					<p id="pb_criar_mensagem_erro" class="error alert alert-danger" style="display: none;"></p>
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

				<form id="pb_criar_formulario" class="form-horizontal" action="php/criarAtendimento.php" method="post">

					<fieldset>
						<div class="d-flex flex-row">
							<div class="offset-sm-4 col-sm-4">
								<input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id'];?>">
								<h5 class="blue">Tipo de Atendimento</h5>
								<select data-name="tipo" class="form-control" name="tipo" id="tipo" required>
									<option value="">Selecione...</option>
									<?php while (($tipo = mysqli_fetch_object($result)) != false):?>
										<option value="<?php echo $tipo->id?>"><?php echo ("$tipo->descricao") ?>
									</option> 
								<?php endwhile; ?>
							</select> 									
							<h5 class="blue">Cliente</h5>
							<input id="nome_cliente" name="nome_cliente" type="text" class="span12 m-wrap form-control">
							<h5 class="blue">Observação</h5>
							<input id="observacao" name="observacao" type="text" class="span12 m-wrap form-control">
							<button type="button" id="pb_criar_gravar" class="btn btn-primary mt-2">Gravar</button>
							<button type='button' class='btn btn-large btn-danger mt-2' onclick='location.href="tipos.php"'><i class="glyphicon glyphicon-remove"></i> VOLTAR</button>                    
						</div>                                              	                                              	
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<br>

</div> <!-- Fim do painel-->




<?php require_once('../../layout/htmls/rodape.php'); ?>
<?php require_once('../../layout/htmls/javascripts.php'); ?>


</body>

</html>
<?php require_once('js/cadastrar_entidades.js'); ?>




