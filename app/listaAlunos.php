<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['nomeAluno'])){
		$aluno = new Aluno();
		$aluno->setIdAluno($_POST['idAluno']);
		$aluno->setNomeAluno($_POST['nomeAluno']);
		$aluno->setEmailAluno($_POST['emailAluno']);
		$aluno->atualizarAluno();
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
<script language="JScript">
function completaEdicao(codigo,nome,email){
	$('#nomeAluno').val(nome);
	$('#emailAluno').val(email);
	$('#idAluno').val(codigo);
	$('#legenda').html('Editando '+nome);
	$('#edicao').css('display','inline');
}
</script>
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
		<div class="large-2 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-10 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-center">Listagem de Alunos Cadastrados</h4>
			<table class="large-12">
				<thead>
					<th width="50%" class="text-center">Nome Completo</th>
					<th width="30%" class="text-center">Email</th>
					<th width="10%" class="text-center"><img src="img/editar.png" width="20"></th>
					<th width="10%" class="text-center">Boletim</th>
				</thead>
				<tbody>
					<?php 
						$a = new Aluno();
						$p = new Professor();
						$p->setIdProfessor($_SESSION['idProfessor']);
						$p = $p->retornaProfessorPorId();
						$alunos = $p->getAluno();
						if(count($alunos) == 0){
							echo '<tr><td colspan="4" class="text-center">Nenhum Aluno Cadastrado</td></tr>';
						} else {
							foreach($alunos as $a){
								echo '<tr>';
								echo '<td>'.$a->getNomeAluno().'</td>';
								echo '<td>'.$a->getEmailAluno().'</td>';
								$texto = $a->getIdAluno().","."'".$a->getNomeAluno()."','".$a->getEmailAluno()."'";
								echo '<td class="text-center"><img src="img/editar.png" width="20" style="cursor: pointer;" onclick="completaEdicao('.$texto.')"></td>';
								echo '<td class="text-center"><img src="img/boletim.png" style="cursor: pointer"></td>';
								echo '</tr>';
							}	
						}
					?>
				</tbody>
			</table>
			<div style="display: none" id="edicao">
				<form id="formEd" method="post">
					<fieldset>
						<legend id="legenda">Editando Aluno</legend>
						<div class="large-12 columns">
							<label>Nome Completo:</label>
								<input type="text" name="nomeAluno" id="nomeAluno">
						</div>
						<div class="large-12 columns">
							<label>Email Válido:</label>
								<input type="email" name="emailAluno" id="emailAluno">
						</div>
						<div class="large-4 columns">&nbsp;</div>
						<div class="large-4 columns">&nbsp;</div>
						<div class="large-4 columns">
							<input type="hidden" name="idAluno" id="idAluno">
							<input type="submit" name="alterar" value="Alterar" class="button large-12">
						</div>
					</fieldset>
				</form>
			</div>
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