<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['a'])){
		$c = new Chamado();
		$c->setIdProfessor($_SESSION['idProfessor']);
		$c->setConteudo('Solicitação de uso do blog');
		$c->setStatus('A');
		$c->setDataChamado(date('Y-m-d'));
		$c->inserirChamado();
		header('Location: blog.php');
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
					<iframe src="blogs/admin" width="950px" height="600px"></iframe>
					<?
				} else {
					$c = new Chamado();
					$chamados = $c->retornarChamadosAbertos();
					$blog = false;
					foreach($chamados as $c){
						if($c->getConteudo() == 'Solicitação de uso do blog'){
							$blog = true;
						}
					}
					if($blog){
						?>
						<h4>Solicitação de Acesso efetuada.</h4>
						<h3>Acompanhe a solicitação <a href="chamados.php">clicando aqui</a></h3>
						<?
					} else {
						?>
						<h4>Solicite o seu acesso ao seu Blog!</h4>
						<h3><a href="blog.php?a=1">Clique Aqui</a></h3>
						<?
					}
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