<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
?>
<html>
<head>
<title>iMestre :: Blog - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('blog')">
	<div class="row"><!-- Linha do header -->
		<?php include('header.php');?>
	</div>
	<div class="row"><!-- Linha do Content -->
		<div class="large-12 columns">
			<?php include('menu.php')?>
			<hr>
		</div>
		<div class="large-12 columns text-center">
			<?php 
				$p = new Professor();
				$p->setIdProfessor($_SESSION['idProfessor']);
				$p = $p->retornaProfessorPorId();
				$f = $p->getFuncionalidades();
				if($f->getBlog() == 'S'){
					?>
					<h4>Poderá ser necessário repetir seu usuário/senha nessa sessão!!</h4>
					<iframe src="dotclear/admin" width="950px" height="600px"></iframe>
					<?
				} else {
					?>
					<h4>Solicite o seu acesso ao seu Blog!</h4>
					<?
				}
			?>
			
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