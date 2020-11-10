<?php
require_once('../../../php/core/main.php');
require_once('../../../php/core/checkSession.php');

	//$prefeiturabairro = $_GET['pb'];
$query ="SELECT * from tipo
order by id ASC";
$ggQuery = mysqli_query($link,$query);

?>
<!DOCTYPE html>
<html>

<?php require_once('../../layout/htmls/header2.php'); ?>


<body class="bootstrap-admin-with-small-navbar">
	<?php require_once('../../layout/htmls/menu-superior-maior.php'); ?>

	<div class="container" style="margin-bottom: 20px;">

		<div class="row">
			
			<!-- content -->
			<div class="col-md-12">
				
				<div class="row">
					<div class="col-lg-12">
						<div class="page-header mt-2">
							<!--a href="usuarios_imprimir.php" ><img alt="" title="Clique aqui para imprimir." height='50px' src="/admin/images/printer.jpg"/></a-->
                            	<?php //verificar quantidade de inscritos 
									//$total = mysqli_query($link,"select * from curso");			
                            	$total = mysqli_num_rows($ggQuery);										
                            	?>
                            	<h1>Tipos de atendimento: <?php echo $total;?></h1>
                            	<a href="cadastrar_entidades.php">
                            		<button class="btn btn-sm right mt-2"  style="margin-bottom:3px; background-color:#6495ed; color:#fff; margin-top: -30px;"><i class="glyphicon glyphicon-plus"></i> Cadastrar</button>
                            	</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    	
                    	<div class="col-lg-12">
                    		<div class="table-responsive">
                    			<table class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">
                    				
                    				<?php if( isset($_GET['sucesso']) ) : ?>
                    					<div  class="form-group" style="margin: 5px 0px;">
                    						<div class="alert alert-success" role="alert">
                    							<b>Deletado com Sucesso.</b>
                    						</div>
                    					</div>
                    				<?php endif; ?>
                    				<?php if( isset($_GET['editarsucesso']) ) : ?>
                    					<div  class="form-group" style="margin: 5px 0px;">
                    						<div class="alert alert-success" role="alert">
                    							<b>Editado com Sucesso.</b>
                    						</div>
                    					</div>
                    				<?php endif; ?>
                    				
                    				<?php if( isset($_GET['deletsucesso']) ) : ?>
                    					<div  class="form-group" style="margin: 5px 0px;">
                    						<div class="alert alert-success" role="alert">
                    							<b>Deletado com Sucesso.</b>
                    						</div>
                    					</div>
                    				<?php endif; ?>
                    				<?php if( isset($_GET['deleterror']) ) : ?>
                    					<div  class="form-group" style="margin: 5px 0px;">
                    						<div class="alert alert-danger" role="alert">
                    							<b>Erro ao excluir</b>
                    						</div>
                    					</div>
                    				<?php endif; ?>									
                    				<thead>
                    					<tr role="row">
                    						<th>Número</th>
                    						<th>Nome</th>																												
                    						<th style="width: 170px;">Opções</th>
                    					</tr>
                    				</thead>								
                    				<tbody>									
                    					<?php if ($total > 0){
                    						while( $gg = mysqli_fetch_object($ggQuery ) ) : ?>
                    							
                    							<tr>
                    								<td><?php echo $gg->id; ?></td>			
                    								<td><?php echo $gg->descricao; ?></td>			
                    								
                    								<td style="text-align:center;">
                    									
                    									<a href="editar_entidades.php?id=<?php echo $gg->id; ?>">
                    										<button class="btn btn-primary opcoes" ><i class="glyphicon glyphicon-pencil"></i> Editar</button>
                    									</a>													
                    									<a href="php/deletarEntidades.php?id=<?php echo $gg->id; ?>" class='confirmation' >
                    										<button class="btn btn-danger opcoes"><i class="glyphicon glyphicon-remove"></i> Deletar</button>
                    									</a>
                    									
                    									<?php if ($gg->ativo == 1) {?>
                    										<a href="bloquear.php?id=<?php echo $gg->id; ?>">
                    											<button class="btn btn-sm opcoes"  style="margin-bottom:3px; background-color:yellow; color:black;"><i class="glyphicon glyphicon-repeat "></i> Inativar</button>
                    										</a>    
                    									<?php }else{?>                                                
                    										<a href="bloquear.php?id=<?php echo $gg->id; ?>">
                    											<button class="btn btn-sm opcoes"  style="margin-bottom:3px; background-color:green; color:white;"><i class="glyphicon glyphicon-repeat "></i> Ativar</button>
                    										</a>                                                      
                    									<?php }?>          												
                    									
                    								</td>
                    							</tr>
                    							
                    						<?php endwhile; }?>

                    						
                    					</tbody>
                    					
                    				</table>
                    				
                    				
                    			</div>
                    			
                    		</div>
                    		
                    	</div>
                    	
                    </div>
                    
                </div>
                <br>
                <br>
                <br>
            </div>

            <?php //require_once('htmls/rodape.php'); ?>
            <?php require_once('../../layout/htmls/javascripts.php'); ?>
            <?php require_once('../../layout/htmls/rodape.php'); ?>
            <?php require_once('../../layout/htmls/javascripts.php'); ?>
            
        </body>
        
        </html>
        <?php require_once('js/deletar.js'); ?>