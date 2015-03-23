<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Alunos - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('listaAluno')">
	<div class="row"><!-- Linha do header -->
		<?php include('header.php');?>
	</div>
	<div class="row"><!-- Linha do Menu -->
		<div class="large-12 columns">
			<?php include('menu.php')?>
		</div>
		<div class="large-12 columns">
			<hr>
		</div>
	</div>
	<div class="row"><!-- Linha do Content -->
		<div class="large-4 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-8 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-center">Listagem de Alunos Cadastrados</h4>
			<table class="large-12">
				<thead>
					<th width="60%" class="text-center">Nome Completo</th>
					<th width="30%" class="text-center">Email</th>
					<th width="10%" class="text-center"><img src="img/editar.png" width="20"></th>
				</thead>
				<tbody>
					<?php 
						$a = new Aluno();
						$alunos = $a->retornaTodosAlunos();
						foreach($alunos as $a){
							echo '<tr>';
								echo '<td>'.$a->getNomeAluno().'</td>';
								echo '<td>'.$a->getEmailAluno().'</td>';
								echo '<td class="text-center"><img src="img/editar.png" width="20"></td>';
							echo '</tr>';
						}
					?>
				</tbody>
			</table>
		</div>
		<hr>
	</div>
	<div class="large-12 columns">
			<?php include('footer.php')?>
	</div>	
</body>
<script>
  $(document).foundation();
</script>
</html>