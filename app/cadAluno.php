<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['nomeAluno'])){
		$aluno = new Aluno();
		$aluno->setNomeAluno($_POST['nomeAluno']);
		$aluno->setEmailAluno($_POST['emailAluno']);
		$aluno->setIdProfessor($_SESSION['idProfessor']);
		$aluno->inserirAluno();
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
<body onload="arrumaMenu('cadAluno')">
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
			<h4 class="text-center">Cadastro de Alunos</h4>
			<form method="post">
				<fieldset>
					<legend>Novo Aluno</legend>
					<div class="large-12 columns">
						<label>Nome Completo:</label>
							<input type="text" name="nomeAluno">
					</div>
					<div class="large-12 columns">
						<label>Email Válido:</label>
							<input type="email" name="emailAluno">
					</div>
					<div class="large-4 columns">&nbsp;</div>
					<div class="large-4 columns">&nbsp;</div>
					<div class="large-4 columns">
						<input type="submit" name="salvar" value="Salvar" class="button large-12">
					</div>
				</fieldset>
			</form>
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