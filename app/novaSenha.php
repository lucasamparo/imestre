<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$p = new Professor();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$professor = $p->retornaProfessorPorId();
	//$nome = explode(" ",$professor->getNomeProfessor());
	$mensagem = "";
	
	if(isset($_POST['antiga'])){
		$antiga = $professor->getSenha();
		if(md5($_POST['antiga']) == $antiga){
			$professor->setSenha(md5($_POST['nova']));
			$professor->atualizaProfessor();
			$mensagem = "Senha modificada com sucesso.";
		} else {
			$mensagem = "Senha Antiga não confere!";
		}
	}
?>
<html>
<head>
<title>iMestre :: Trocar Senha</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('perfil')">
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
			<form method="post" action="novaSenha.php">
				<fieldset>
					<legend>Trocar Senha de Acesso</legend>
					<div class="large-5 columns">
						<label>Senha Antiga:</label>
						<input type="password" name="antiga" required>
					</div>
					<div class="large-5 columns">
						<label>Senha Nova:</label>
						<input type="password" name="nova" required>
					</div>
					<div class="large-2 columns">
						<label>&nbsp;</label>
						<input type="submit" value="Modificar" class="button tiny large-12">
					</div>
				</fieldset>
				<p class="text-center"><?= $mensagem;?></p>
			</form>
		</div>
		<div class="large-12 columns">
			<hr>
			<?php include('footer.php')?>
		</div>
	</div>
</body>
<script>
  $(document).foundation();
</script>
</html>