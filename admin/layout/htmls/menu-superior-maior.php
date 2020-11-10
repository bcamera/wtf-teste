  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #fefefe!important; font-size: 20px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.11);">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown" style="justify-content: center;">
    <ul class="navbar-nav">
      <!--<li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>-->
      <?php $nivel = consultar($link, "fk_nivel", "usuario", "id", $_SESSION['id'])?>
      <?php if  ($nivel == 1 || $nivel == 2){?>
      <li class="nav-item dropdown">
      	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #4cc3f3">
          Cadastro
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item blue" href="../../sistema/cadastrar/tipos.php">Tipos de Atendimentos</a>
          <a class="dropdown-item blue" href="../../sistema/cadastrar/atendimento.php">Atendimentos</a>
        </div>
      </li>      
      <li class="nav-item">
        <a class="nav-link corEscuro" href="../../sistema/atendimento/index.php">Relatório</a>
      </li>
      <li class="nav-item">
        <a class="nav-link corEscuro" href="../../sistema/usuarios/index.php" style="color: #5d91bf;">Usuário</a>
      </li>
  <?php } else {?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #4cc3f3">
          Cadastro
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item blue" href="../../sistema/cadastrar/tipos.php">Tipos de Atendimentos</a>
          <a class="dropdown-item blue" href="../../sistema/cadastrar/atendimento.php">Atendimentos</a>
        </div>
      </li>      
      <li class="nav-item">
        <a class="nav-link corEscuro" href="../../sistema/atendimento/index.php">Relatório</a>
      </li>      
  <?php }?>
	<li class="nav-item dropdown pull-right-md">
		<a href="#" class="nav-link dropdown-toggle corEscuro" ahref="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="corEscuro" aria-hidden="true"></span><span> <?php  echo strtoupper( $_SESSION['nome'] ); ?></span><span class="caret"></span>
		</a>
		<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
			<li><a href="../../../admin/php/logout.php">Sair</a></li>
		</ul>
	</li>      
    </ul>
  </div>
</nav>