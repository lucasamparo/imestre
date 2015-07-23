<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$p = new Professor();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$professor = $p->retornaProfessorPorId();
	$nome = explode(" ",$professor->getNomeProfessor());
	
	if(isset($_POST['conteudo'])){
		$l = new Lembrete();
		$l->setDataLembrete(date('Y-m-d'));
		$l->setConteudo($_POST['conteudo']);
		$l->setIdProfessor($_SESSION['idProfessor']);
		$l->inserirLembrete();
		header('Location: inicio.php');
	}
?>

<html>
<head>
<title>iMestre :: Início - Professor <?php echo $professor->getNomeProfessor();?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
</head>
<body>
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
			<form method="post">
				<fieldset>
					<legend>Novo Lembrete</legend>
					<div class="large-8 columns">
						<label>Conteúdo:</label>
						<textarea name="conteudo" rows="4"></textarea>
					</div>
					<div class="large-4 columns">
						<label>&nbsp;</label>
						<input type="submit" value="Salvar" class="large-12 button tiny">
					</div>
				</fieldset>
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