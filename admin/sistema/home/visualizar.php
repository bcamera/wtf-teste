<?php
require_once('../../../../php/core/main.php');
require_once('../../../../php/core/checkSession.php');

$id = sanitize($link,'id');

$instrucao_atualizacao = "SELECT *, ta.tipo as descricao_tipo, se.descricao, og.descricao as orgao_responsavel
FROM agendamento ag
LEFT JOIN servico se
ON ag.fk_servico_solicitado = se.id
LEFT JOIN tipo_agendamento ta
ON ag.fk_tipo =  ta.idtipoAgendamento
LEFT JOIN retomadadoturismo.orgao as og
ON ag.orgao_responsavel = og.idservicos
WHERE ag.id=".$id;

$temp = mysqli_query($link, $instrucao_atualizacao);
$gg = mysqli_fetch_object( mysqli_query($link, $instrucao_atualizacao) );

if ($gg->fk_hora_agendamento == '8'){
	$gg->fk_hora_agendamento = "08:00 às 13:00";
}	
elseif ($gg->fk_hora_agendamento == '13'){
	$gg->fk_hora_agendamento = "13:00 às 18:00";
}

?>
<!DOCTYPE html>

<html>
<?php include('../../../admin/htmls/barra_prefeitura.php'); ?>

		<title>Retomada do Turismo</title>
		<!--<link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon"/>-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

		<!-- Bootstrap -->
		<link rel="stylesheet" media="screen" href="../../../admin/css/bootstrap.min.css">
		<link rel="stylesheet" media="screen" href="../../../admin/css/bootstrap-theme.min.css">
		<link rel="stylesheet" media="screen" href="../../../layout/css/sweetalert2.min.css">
		<link rel="stylesheet" media="screen" href="../../../admin/css/style.css">
		<link rel="stylesheet" media="screen" href="../../../admin/css/custom.css">
		<link rel="stylesheet" media="(max-width: 640px)" href="../../../admin/css/style_celular.css">
	<!-- 	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

		<!-- Vendors -->
		<link rel="stylesheet" media="screen" href="../../../admin/css/dataTables.min.css" />
		<link rel="stylesheet" media="screen" href="../../../admin/css/styleTabela.css" />
		<link rel="stylesheet" media="screen" href="../../../admin/css/lightbox.css" />

		<script type="text/javascript" src="../../../layout/js/jquery-2.0.3.min.js"></script>
		<script type="text/javascript" src="../../../layout/js/jquery.maskedinput.min.js"></script>
		<script type="text/javascript" src="../../../layout/js/jquery.form.min.js"></script>
		<script type="text/javascript" src="../../../layout/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../../layout/js/sweetalert2.min.js"></script>

		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

	<style type="text/css">

		body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) { overflow-y: visible !important; }
		.row{
			position: relative;

		}

		.agendamento{
			padding-top: 80px;
		}

		th.ui-datepicker-week-end,
		td.ui-datepicker-week-end {
		    display: none;
		}		

		label, h1, h4, h5 {color: white;}
		#agendar{
			background-color: #326eaa;
			color: white;
			float: right;
			margin-bottom: 30%;
		}
		.logo {
			margin-top: 40px!important;
			margin-bottom: 5%!important;
		}
		.logo img{
			max-width:35%!important;
		}
		.banner{
			background: url("../../../layout/images/bg.png");
			 background-size: cover;
		}

		@media (max-width: 575.98px) {
		  	.ui-widget.ui-widget-content {
    			margin-bottom: 100px!important;
			}
		}
		li{
			line-height: 1.8;
			margin-bottom: 8px;
			text-align: justify;
		}
		.modal-body {
		    padding-right: 35px;
		}
		h2 {
			color:white;
		}
		button, input, select, textarea {
			color: black;
		}
		th{
			color: white;
		}
		#example_info{
			color: white;
		}
		.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
			color: white;	
		}

		* {
		    margin: 0;
		}

		html, body {
		    height: 100%;
		}

		.banner {
		    min-height: 100%;
		    height: auto !important;
		    height: 100%;
		    margin: 0 auto -20px;
		}

		.footer, .push {
		    height: 20px;
		}		
	</style>  		 	


<body class="bootstrap-admin-with-small-navbar">

 <div class="banner" style="padding-top: 5%;">
    <div class="container" >
	    <form id="fale_conosco" method="post" class="form-validate fale_conosco" enctype="multipart/form-data">
	        <div class="row">
	        	<div class="col-lg-offset-1 col-lg-10">
	        		<div class="form">
			            <div class="col-lg-12" style="border-bottom:1px solid #eee;">
			                <h1>Inscrição</h1>
			            </div>
			            <div class="form-group">
			            	<div class="col-lg-11">
				            	<h2>Dados do Inscrito:</h2>
				            </div>
				            <div class="form-group">
					            <div class="col-lg-6 form-nome">					                
					                <h5>Nome do Solicitante:</h5> 					                			                
					                <input type="text" name="nome_solicitante" id="nome_solicitante" class="input-form-nome  form-control" value="<?php echo $gg->nome_solicitante; ?>" readonly required/>      				                       
					            </div>
					            <div class="col-lg-6 form-cpf">
					            	<h5>CPF:</h5>      
						            <input type="text" name="cpf" id="cpf" class="input-form-estado_civil form-control" value="<?php echo $gg->cpf; ?>" readonly required/>     
					            </div>
					        </div>
					        <div class="form-group">
					            <div class="col-lg-6 form-cpf">
					            	<h5>Nome Fantasia:</h5>      
						            <input type="text" name="estado_civil" id="estado_civil" class="input-form-estado_civil form-control" value="<?php echo $gg->nome_fantasia; ?>" readonly required/>     
					            </div>
					            <div class="col-lg-6 form-email">
					                <h5>Razão Social:</h5> 
					                <input type="text" name="razao_social" id="razao_social" class="input-form-cpf form-control" value="<?php echo $gg->razao_social; ?>" readonly required/>               
					            </div>	
					        </div>
					        <div class="form-group">
					            <div class="col-lg-6 form-email">
					                <h5>Ramo de Atividade:</h5> 
					                <input type="text" name="ramo_atividade" id="ramo_atividade" class="input-form-cpf form-control" value="<?php echo $gg->ramo_atividade; ?>" readonly required/>               
					            </div>	
					            <div class="col-lg-6 form-email">
					                <h5>Descrição do Serviço:</h5> 
					                <input type="text" name="descricao_servico" id="descricao_servico" class="input-form-cpf form-control" value="<?php echo $gg->descricao_servico; ?>" readonly required/>               
					            </div>		
					        </div>
					        <div class="form-group">
					            <div class="col-lg-6 form-email">
					                <h5>Orgão Responsável:</h5> 
					                <input type="text" name="orgao_responsavel" id="orgao_responsavel" class="input-form-cpf form-control" value="<?php echo $gg->orgao_responsavel; ?>" readonly required/>               
					            </div>	
					            <div class="col-lg-6 form-email">
					                <h5>Serviço Solicitado:</h5> 
					                <input type="text" name="fk_servico_solicitado" id="fk_servico_solicitado" class="input-form-cpf form-control" value="<?php echo $gg->descricao; ?>" readonly required/>               
					            </div>		
					        </div>
					        <div class="form-group">
					            <div class="col-lg-6 form-email">
					                <h5>Data do Agendamento:</h5> 
					                <input type="text" name="data_agendamento" id="data_agendamento" class="input-form-cpf form-control" value="<?php echo $gg->data_agendamento; ?>" readonly required/>               
					            </div>	
					            <div class="col-lg-6 form-email">
					                <h5> Agendamento:</h5> 
					                <input type="text" name="fk_hora_agendamento" id="fk_hora_agendamento" class="input-form-cpf form-control" value="<?php echo $gg->fk_hora_agendamento; ?>" readonly required/>               
					            </div>		
					        </div>
					        <div class="form-group">
					            <div class="col-lg-6 form-email">
					                <h5>Tipo:</h5> 
					                <input type="text" name="fk_tipo" id="fk_tipo" class="input-form-cpf form-control" value="<?php echo $gg->descricao_tipo; ?>" readonly required/>               
					            </div>	
					            <div class="col-lg-6 form-email">
					                <h5> Email:</h5> 
					                <input type="text" name="email" id="email" class="input-form-cpf form-control" value="<?php echo $gg->email; ?>" readonly required/>               
					            </div>		
					        </div>
					        <div class="form-group">
					            <div class="col-lg-6 form-email">
					                <h5>Telefone:</h5> 
					                <input type="text" name="telefone" id="telefone" class="input-form-cpf form-control" value="<?php echo $gg->telefone; ?>" readonly required/>               
					            </div>	
					            <div class="col-lg-6 form-email">
					                <h5> Instagram:</h5> 
					                <input type="text" name="instagram" id="instagram" class="input-form-cpf form-control" value="<?php echo $gg->instagram; ?>" readonly required/>               
					            </div>		
					        </div>	
					        <div class="form-group">
					            <div class="col-lg-6 form-email">
					                <h5>Facebook:</h5> 
					                <input type="text" name="facebook" id="facebook" class="input-form-cpf form-control" value="<?php echo $gg->facebook; ?>" readonly required/>               
					            </div>	
					            <div class="col-lg-6 form-email">
					                <h5> Twitter:</h5> 
					                <input type="text" name="twitter" id="twitter" class="input-form-cpf form-control" value="<?php echo $gg->twitter; ?>" readonly required/>               
					            </div>		
					        </div>		
					        <div class="form-group">
					            <div class="col-lg-6 form-email">
					                <h5>Website:</h5> 
					                <input type="text" name="website" id="website" class="input-form-cpf form-control" value="<?php echo $gg->website; ?>" readonly required/>               
					            </div>	
					            <div class="col-lg-6 form-email">
					                <h5> Instagram:</h5> 
					                <input type="text" name="instagram" id="instagram" class="input-form-cpf form-control" value="<?php echo $gg->instagram; ?>" readonly required/>               
					            </div>		
					        </div>						        				        				        

					    </div>      
			            <div class="text-center" style="margin-bottom: 5rem;">
							<!-- <button type='submit' id='realizado' name="realizado" value="true" class='btn btn-large btn-success'><i class="glyphicon glyphicon-ok"></i> REALIZADO</button>&nbsp;&nbsp;&nbsp; -->
							<button type='button' class='btn btn-large btn-danger' style=" margin-top:20px;" onclick='javascript:window.location.replace("index.php");'><i class="glyphicon glyphicon-remove"></i> VOLTAR</button>
						</div>
					</div>
				</div>
	        </div>
	    </form>
	</div>
</div>

<?php require_once('../../htmls/rodape.php'); ?>
<?php require_once('../../htmls/javascripts.php'); ?>
</body>