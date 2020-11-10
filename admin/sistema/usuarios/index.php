<?php
require_once('../../../php/core/main.php');
require_once('../../../php/core/checkSession.php');

if( ! logado('id'))
{
  header('Location: ../../index.php?loginerror');
}

$sql = "SELECT *, usuario.id AS id 
FROM usuario
JOIN nivel ON usuario.fk_nivel = nivel.id";

$result = mysqli_query($link , $sql);

?>
<!DOCTYPE html>
<html>

<?php require_once('../../layout/htmls/header2.php'); ?>
<body class="bootstrap-admin-with-small-navbar">
    <div class='topoForm' ></div>
    <?php require_once('../../layout/htmls/menu-superior-maior.php'); ?>

    <div class="container" style="padding-bottom: 5%;">
        <h2>Usuários</h2>
        <?php if ($_SESSION['nivel'] != 3) {?>
            <a href="cadastrar_usuario.php">
                <button id="botao_inserir" class="btn btn-sm pull-right btn-primary"><i class="glyphicon glyphicon-pencil"></i> Criar novo Usuário</button>
            </a>
        <?php } ?>
        <div class="row mt-2">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">
                    <thead>
                        <tr role="row">
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Nivel</th>
                            <th>Status</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while( $gg = mysqli_fetch_object( $result ) ){ ?>
                            <tr>
                                <td><?php echo $gg->nome; ?></td>
                                <td><?php echo $gg->email; ?></td>
                                <td><?php echo $gg->nivel; ?></td>
                                <td><?php echo $gg->ativo == 1 ? 'Ativo' : 'Inativo'; ?></td>
                                <td width="150">
                                    <?php if ($_SESSION['nivel'] != 3)  {?>
                                        <?php if ($gg->id != 1) {?>
                                            <a href="deletarUsuario.php?id=<?php echo $gg->id ?>" onclick='return confirm("Deseja realmente deletar?")'><button class="btn btn-sm btn-danger opcoes"><i class="glyphicon glyphicon-trash"></i> Excluir</button></a>
                                            <a href="editarUsuario.php?id=<?php echo $gg->id; ?>">
                                                <button class="btn btn-sm opcoes"  style="margin-bottom:3px; background-color:#6495ed; color:#fff;"><i class="glyphicon glyphicon-repeat "></i> Editar Usuario</button>
                                            </a>                                                  
                                            <a href="resetarSenha.php?id=<?php echo $gg->id; ?>">
                                                <button class="btn btn-sm opcoes"  style="margin-bottom:3px; background-color:#6495ed; color:#fff;"><i class="glyphicon glyphicon-repeat "></i> Resetar Senha</button>
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
                                            <?php }?>                          
                                        <?php }?>                                              
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once('../../layout/htmls/rodape.php'); ?>
        <?php require_once('../../layout/htmls/javascripts.php'); ?>

        <script src="js/index.js"></script>
    </body>
    </html>