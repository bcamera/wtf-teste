<?php
require_once('../../../php/core/main.php');
	
	//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Agendamento SIMM - Primeiro Acesso</title>
<?php require_once('../../layout/htmls/header2.php'); ?>

        <!-- Custom styles -->
        <style type="text/css">
            .alert{
                margin: 0 auto 20px;
            }
        </style>
	
    </head>
    <body class="bootstrap-admin-without-padding" style="background:url('../../../layout/img/fundo.png') no-repeat center top fixed; ">
    	<div class="banner" style="width:100%; height:280px; margin-bottom: 0px;margin-top:-45px ;  border-bottom: 0px solid #ddd;"></div>	
        <div class="container">
           <div class="">
                <div class="col-lg-4" style="margin: auto;">
				
					<?php if( isset($_GET['loginerror']) ) : ?>
						<div class="alert alert-danger">
							<a class="close" data-dismiss="alert" href="#">&times;</a>
							Os dados fornecidos são inválidos. Verifique-os
						</div>
					<?php endif; ?>
                   
				   <form method="post" action="primeiroLogin.php" class="bootstrap-admin-login-form">
				   		<img src="../../images/Marca.png" width="300px">
                        <h4>Primeiro Acesso -  Redefinir Senha.</h4>
                        <div class="form-group">
                            <input class="form-control" type="password" name="senha1" placeholder="Nova Senha" id="senha1" >
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="senha2" placeholder="Repita Senha" id="senha2">
                        </div>
                        <button class="btn btn-lg btn-primary" id="btn_salvar">Mudar Senha</button>
                    </form>
					
                </div> <!--fim div col-lg-12-->
            </div>
        </div>


                <?php require_once('../../layout/htmls/rodape.php'); ?>
                <?php require_once('../../layout/htmls/javascripts.php'); ?>
        <script type="text/javascript" charset="UTF-8">
		$( "#btn_salvar" ).click(function() {
			var senha1 = $("#senha1").val();
			var senha2 = $("#senha2").val();
			if(senha1 != senha2 )
				{	
					 
					alert("As Senhas São Diferentes" );
					$("#senha1").focus();
					return false;
				}
				else
				{
					if(senha1 =='123456' && senha2 == '123456')
					{
						alert('Use Outra Senha.');
						$("#senha1").focus();
						return false;
					}
					else
					{
						$("form").submit();
					}
				}
				
		  });
		   
		</script>
    </body>
</html>
