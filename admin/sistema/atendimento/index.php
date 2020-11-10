<?php
require_once('../../../php/core/main.php');
require_once('../../../php/core/checkSession.php');


$query = "SELECT *, u.nome as tecnico, t.descricao as tipo FROM atendimento a
join usuario u on a.fk_usuario = u.id
join tipo t on a.fk_tipo = t.id";
$ggQuery = mysqli_query($link,$query);

$id = $_SESSION['id'];
$fk_nivel = consultar($link, 'fk_nivel', "usuario", "id", "$id");   
$nivel = consultar($link, 'nivel', "nivel", "id", "$fk_nivel");   

// var_dump($nivel);die;
$sql_complemento = "";

$filtro = sanitize( $link , 'filtro');
if (!$filtro) {
  $filtro = date('Y-m-d');
}
$sql_complemento .= "DATE(a.data)='".($filtro)."' ";

$filtro_tipo = sanitize( $link , 'filtro_tipo');
if ($filtro_tipo != 'Todos' and $filtro_tipo) {
  $sql_complemento .= "and a.fk_tipo=".$filtro_tipo." ";
}

$filtro_tecnico = sanitize( $link , 'filtro_tecnico');
if ($filtro_tecnico != 'Todos' and $filtro_tecnico) {
  $sql_complemento .= "and a.fk_usuario=".$filtro_tecnico." ";
}

//var_dump($_POST);
//var_dump(isset($_POST['filtro_compareceu']));

$filtro_cliente = sanitize( $link , 'filtro_cliente');
if ($filtro_cliente != 'Todos' and $filtro_cliente) {
  $sql_complemento .= "and a.nome_cliente='".$filtro_cliente."' ";
}



if ($filtro and $filtro != 'TODOS') {
  $query ="SELECT *, u.nome as tecnico, t.descricao as tipo FROM atendimento a
join usuario u on a.fk_usuario = u.id
join tipo t on a.fk_tipo = t.id and ".$sql_complemento;
}
//echo $query;

//var_dump($sql_complemento);die;
//var_dump($query);die;
$ggQuery = mysqli_query($link,$query);

// $queryAgendas = "SELECT distinct data from agendamento 
// order by data asc";
// $ggQueryAgendas = mysqli_query($link,$queryAgendas);

// $queryServico = "SELECT * from servico";
// $ggQueryServico = mysqli_query($link,$queryServico);
// var_dump($filtro_compareceu);


$queryTipo = "SELECT * from tipo";
$ggQueryTipo = mysqli_query($link,$queryTipo);


$queryTecnico = "SELECT * from usuario where fK_nivel = 3";
$ggQueryTecnico = mysqli_query($link,$queryTecnico);

$queryCliente = "SELECT DISTINCT nome_cliente from atendimento";
$ggQueryCliente = mysqli_query($link,$queryCliente);


?>
<!DOCTYPE html>
<html>

<?php require_once('../../layout/htmls/header2.php'); ?>


<body class="bootstrap-admin-with-small-navbar">
  <!-- <div style="width:100%; height:280px; margin-bottom: 30px; background:url('images/fundo_geral.jpg') top center no-repeat; border-bottom: 5px solid #ddd;"></div> -->
  <?php require_once('../../layout/htmls/menu-superior-maior.php'); ?>

  <div class="container" >
    <div class="row">
      <!-- content --> 
      <div class="col-md-12">
        <div class="col-lg-12">
          <div class="page-header">
                                  <?php //verificar quantidade de inscritos     
                                  $total = mysqli_num_rows($ggQuery);
                                  ?>
                                  <h1>Atendimentos: <?php echo $total;?></h1><hr>
                                  <button id="maisfiltros" class="btn btn-info" style="margin-top: -20px;width: 200px;">+ Filtros</button>
                                  <form method="post">
                                    <div class="row" id="select-filtro-wrapper">
                                      <div class="col-lg-3 text-center filtro-1">
                                        <h2>Tipos de Atendimento</h2>
                                        <select class="form-control" name="filtro_tipo" value="<?php echo $filtro_tipo; ?>" >
                                          <option>Todos</option>
                                          <?php while( $gg = mysqli_fetch_object($ggQueryTipo) ) : ?>
                                            <option value="<?php echo $gg->id; ?>" <?php echo $filtro_tipo == $gg->id ? 'selected' : ''; ?> ><?php echo $gg->descricao; ?></option>
                                          <?php endwhile; ?>
                                        </select>
                                      </div>      
                                      <div class="col-lg-3 text-center filtro-1">
                                        <h2>Técnico</h2>
                                        <select class="form-control" name="filtro_tecnico" value="<?php echo $filtro_tecnico; ?>" >
                                          <option>Todos</option>
                                          <?php while( $ggTecnico = mysqli_fetch_object($ggQueryTecnico) ) : ?>
                                            <option value="<?php echo $ggTecnico->id; ?>" <?php echo $filtro_tecnico == $ggTecnico->id ? 'selected' : ''; ?> ><?php echo $ggTecnico->nome; ?></option>
                                          <?php endwhile; ?>
                                        </select>
                                      </div>  
                                      <div class="col-lg-3 text-center filtro-1">
                                        <h2>Cliente</h2>
                                        <select class="form-control" name="filtro_cliente" value="<?php echo $filtro_cliente; ?>" >
                                          <option>Todos</option>
                                          <?php while( $ggCliente = mysqli_fetch_object($ggQueryCliente) ) : ?>
                                            <option value="<?php echo $ggCliente->nome_cliente; ?>" <?php echo $filtro_cliente == $ggCliente->nome_cliente ? 'selected' : ''; ?> ><?php echo $ggCliente->nome_cliente; ?></option>
                                          <?php endwhile; ?>
                                        </select>
                                      </div>                                                                       
                                      <div class="col-lg-3 text-center filtro-1">
                                        <button class="form-control btn btn-primary" style="margin-top: 45px;" type="submit" > Enviar</button> 
                                      </div>
                                      <div class="offset-lg-4 col-lg-4 text-center" style="margin-top: 20px;">
                                        <h2>Datas</h2>
                                        <input class="form-control" type="date" name="filtro" value="<?php echo $filtro; ?>"  onchange='if(this.value != 0) { this.form.submit(); }'>
                                      </div>
                                    </div>
                                  </form>                                  
                                </div>                                
                              </div>
                            </div>  
                            <div class="col-lg-12">
                              <div class="table-responsive" id="tabela">
                               <table class="table table-striped table-bordered dataTable no-footer" id="agendamentos" aria-describedby="example_info" role="grid">

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
                            <th>Data</th>                                                                                              

                            <th>Tipo de Atendimento</th>                                                                                                           
                            <th>Observação</th>                                                                                                         
                            <th>Técnico</th>                                                                                                            
                            <th>Cliente</th>                                                      
                          </tr>
                        </thead>                
                        <tbody>                 
                          <?php 
                            while( $gg = mysqli_fetch_object($ggQuery ) ) { ?>

                              <tr>
                                <td><?php echo $gg->id; ?></td>     
                                <td><?php echo $gg->data; ?></td>           
                                <td><?php echo $gg->tipo; ?></td>           
                                <td><?php echo $gg->observacao; ?></td>           
                                <td><?php echo $gg->tecnico; ?></td>            
                                <td><?php echo $gg->nome_cliente; ?></td>     

                              </tr>

                            <?php  }?>


                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>    
                <br>
                <br>
                <br>
                <?php //require_once('htmls/rodape.php'); ?>
                <script type="text/javascript">
                  $('.filtro-1').each(function(){
                    $(this).hide();
                  })
                  $('#maisfiltros').click(function(){
                    $('.filtro-1').toggle();
                    if ( $(this).html() == "+ Filtros" ) {
                      $(this).html('- Filtros');
                    }else{
                      $(this).html('+ Filtros');
                    }
                  })
                </script>
                <?php require_once('../../layout/htmls/javascripts.php'); ?>
                <?php require_once('../../layout/htmls/rodape.php'); ?>

              </body>
              </html>
              <?php // require_once('js/deletar.js'); ?>