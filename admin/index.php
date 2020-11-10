<?php
	require_once('../php/core/main.php');

	if( isset($_SESSION['id']) ){
		header('Location: sistema/index.php');
	}
	
?>
<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <?php include('layout/htmls/header.php'); ?>
       
    </head>
	<body>
        <div class="container-fluid administrativa h-100 my-auto">
            <div class="row">
            <div class="col-12">
                <div class="col-4 mx-auto ">
                    <img class="tamanho100" src="images/Marca.png">
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mx-auto ">
					<?php if( isset($_GET['loginerror']) ) : ?>
						<div class="alert alert-danger">
							<a class="close" data-dismiss="alert" href="#">&times;</a>
							Os dados fornecidos são inválidos. Verifique-os
						</div>
					<?php endif; ?>
				   <form method="post" action="php/login.php" class="bootstrap-admin-login-form">
                        <h4 class="branco text-center">Área administrativa</h4>
                        <div class="form-group">
                            <input class="form-control" type="text" name="email" placeholder="Login">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="senha" placeholder="Senha">
                        </div>
                        <button class="btn backAzul branco tamanho100" type="submit">ENTRAR</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once('layout/htmls/rodape.php'); ?> 
        <?php require_once('layout/htmls/javascripts.php'); ?> 

        <script type="text/javascript" src="layout/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {
                // Setting focus
                $('input[name="email"]').focus();

                // Setting width of the alert box
                var alert = $('.alert');
                var formWidth = $('.bootstrap-admin-login-form').innerWidth();
                var alertPadding = parseInt($('.alert').css('padding'));

                if (isNaN(alertPadding)) {
                    alertPadding = parseInt($(alert).css('padding-left'));
                }

                $('.alert').width(formWidth - 2 * alertPadding);
            });
        </script>
    </body>
</html>
